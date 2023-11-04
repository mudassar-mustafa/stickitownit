<?php

namespace App\Console\Commands;

use App\Models\Generation;
use App\Models\GenerationImage;
use Illuminate\Console\Command;

use App\Helpers\Helper;

class GetLeonardoGenerations extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leonardo:generations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Leonardo Generations  By Leonardo Generations ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $generations = Generation::whereStatus('pending')->get();
            if (!empty($generations) && count($generations) > 0) {
                foreach ($generations as $generation) {
                    $response = Helper::getGenerations($generation->leonardo_generation_id);
                    if ($response['success'] === true) {

                        if (isset($response['data']['error'])) {
                        } else {
                            if (isset($response['data']['generations_by_pk']) && !is_null($response['data']['generations_by_pk']) && !empty($response['data']['generations_by_pk']['generated_images']) && count($response['data']['generations_by_pk']['generated_images']) > 0) {
                                $images = $response['data']['generations_by_pk']['generated_images'];
                                foreach ($images as $image) {
                                    $file = $image['url'];
                                    if ($file) {
                                        $url = $file;
                                        $imageName = time() . '.' . 'jpg';
                                        file_put_contents(public_path('uploads/generations') . '/' . $imageName, file_get_contents($url));
                                        GenerationImage::create([
                                            'generation_id' => $generation->id,
                                            'user_id' => $generation->user_id,
                                            'image' => $imageName,
                                        ]);

                                    }

                                }
                                $generation->status = 'active';
                                $generation->save();
                            }

                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }
}
