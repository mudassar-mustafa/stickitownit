<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PackageSubscription;

class PackageExpireCron extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packageExpire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Package Expire';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $currentDate = date('Y-m-d H:i:s');
            $userPackages = PackageSubscription::where('status', 'active')->where('end_date' < $currentDate)->get();
            foreach ($userPackages as $key => $userPackage) {
                $userPackage->status = "expired";
                $userPackage->save();
            }       
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }        
    }
}
