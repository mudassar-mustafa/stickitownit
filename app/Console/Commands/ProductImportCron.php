<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass; 
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeGroup;
use App\Models\ProductAttributeValueGroup;

class ProductImportCron extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productImport:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Product Import';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '-1');
        $uploadFile = "";

        $files = [
            //['Diecut Sticker', 'diecut-stickers.png', '/diecut_sticker.csv', '0'],
            ['Circle Sticker', 'circle-stickers.png', '/circle_sticker.csv', '1'],
            //['Rectangle Sticker', 'rectangle-stickers.png', '/rectangle_sticker.csv', '0'],
            ['Square Sticker', 'square-stickers.png', '/square_sticker.csv', '1'],
            //['Diecut Label', 'diecut-label.png', '/diecut_label.csv', '0'],
            ['Circle Label', 'circle-label.png', '/circle_label.csv', '1'],
            //['Rectangle Label', 'rectangle-label.png', '/rectangle_label.csv', '0'],
            ['Square Label', 'square-label.png', '/square_label.csv', '1'],
        ];

        try {
            foreach ($files as $fileDetail) {
                $import = new YourImportClass();
                $data = Excel::toCollection($import, storage_path() . "/app".$fileDetail[2]."");
                //return $data[0];
                foreach ($data[0] as $key => $value) {
                    if($key != 0){
                        $product = Product::where('title', strtolower($fileDetail[0]))->first();
                        if(empty($product)){
                            $product = new Product;
                            $product->title = $fileDetail[0];
                            $product->slug = \Str::slug(strtolower($fileDetail[0]));
                            $product->product_type = "variation";
                            $product->main_image = $fileDetail[1];
                            $product->quantity = 0;
                            $product->price = 0.0;
                            $product->brand_id = 1;
                            $product->shipping_type = "free";
                            $product->status = "active";
                            $product->save();
                        }
    
                        $product->categories()->sync([1]);
    
                        $attributeMaterialId = Attribute::where('name', strtolower('material'))->value('id');
                        $attributeSizeId = Attribute::where('name', strtolower('size'))->value('id');
                        $attributeQuantityId = Attribute::where('name', strtolower('quantity'))->value('id');
    
                        $product->attributes()->sync([$attributeMaterialId, $attributeSizeId, $attributeQuantityId]);
    
    
    
                        $attributeValueMaterial = AttributeValue::where('name', strtolower($value[2]))->where('attribute_id', $attributeMaterialId)->first();
                        if(empty($attributeValueMaterial)){
                            $attributeValueMaterial = new AttributeValue;
                            $attributeValueMaterial->attribute_id = $attributeMaterialId;
                            $attributeValueMaterial->name = $value[2];
                            $attributeValueMaterial->slug = \Str::slug(strtolower($value[2]));
                            $attributeValueMaterial->status = 'active';
                            $attributeValueMaterial->save();
                        }


                        $size = $fileDetail['3'] == '0' ? "".$value[3]."x".$value[4]."" : $value[3];
                        $attributeValueSize = AttributeValue::where('name', strtolower($size))->where('attribute_id', $attributeSizeId)->first();
                        if(empty($attributeValueSize)){
                            $attributeValueSize = new AttributeValue;
                            $attributeValueSize->attribute_id = $attributeSizeId;
                            $attributeValueSize->name = $size;
                            $attributeValueSize->slug = \Str::slug(strtolower($size));
                            $attributeValueSize->status = 'active';
                            $attributeValueSize->save();
                        }

                        $qty = $fileDetail['3'] == '0' ? $value[5] : $value[4];
                        $attributeValueQuantity = AttributeValue::where('name', strtolower($qty))->where('attribute_id', $attributeQuantityId)->first();
                        if(empty($attributeValueQuantity)){
                            $attributeValueQuantity = new AttributeValue;
                            $attributeValueQuantity->attribute_id = $attributeQuantityId;
                            $attributeValueQuantity->name = $qty;
                            $attributeValueQuantity->slug = \Str::slug(strtolower($qty));
                            $attributeValueQuantity->status = 'active';
                            $attributeValueQuantity->save();
                        }
    
                        $productAttributeGroup = new ProductAttributeGroup;
                        $productAttributeGroup->product_id = $product->id;
                        $productAttributeGroup->main_image = $fileDetail[1];
                        $productAttributeGroup->short_description = "".$value[2]."-".$size."-".$qty."";
                        $productAttributeGroup->sku = $key + 1;
                        $productAttributeGroup->quantity = 100000;
                        $productAttributeGroup->price = $value[9];
                        $productAttributeGroup->visibilty = true;
                        $productAttributeGroup->save();
    
                        $productAttributeValueGroup = new ProductAttributeValueGroup;
                        $productAttributeValueGroup->product_id = $product->id;
                        $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                        $productAttributeValueGroup->product_attribute_val_id = $attributeValueMaterial->id;
                        $productAttributeValueGroup->save();
    
                        $productAttributeValueGroup = new ProductAttributeValueGroup;
                        $productAttributeValueGroup->product_id = $product->id;
                        $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                        $productAttributeValueGroup->product_attribute_val_id = $attributeValueSize->id;
                        $productAttributeValueGroup->save();
    
                        $productAttributeValueGroup = new ProductAttributeValueGroup;
                        $productAttributeValueGroup->product_id = $product->id;
                        $productAttributeValueGroup->product_group_id = $productAttributeGroup->id;
                        $productAttributeValueGroup->product_attribute_val_id = $attributeValueQuantity->id;
                        $productAttributeValueGroup->save();
                    }
    
                }
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }        
    }
}
