<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapeConcorde extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:c2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
//        $client = new Client();
//        $crawler = $client->request('GET', 'https://www.allgigs.co.uk/view/venue/140/Concorde-2-Brighton.html');
//
//        $links = $crawler->filter('a.url')->each(function($node) {
//            $href  = $node->attr('href');
//            return $href;
//        });
//
//        foreach($links as $key => $link){

            $client = new Client();
            $crawler = $client->request('GET', 'https://www.ents24.com/brighton-events/concorde-2');

            $crawler->filter('img, .when, .what')->each(function ($node) {
                $image = $node->attr('src');
                $date  = $node->attr('datetime');
                $output = $node->text()."\n";


                print_r($date);
                print_r($image);
                print_r($output);

            });
//        }
    }
}
