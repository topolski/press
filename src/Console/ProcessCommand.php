<?php

namespace topolski\Press\Console;

use Illuminate\Console\Command;
use topolski\Press\Facades\Press;
use topolski\Press\Repositories\PostRepository;

class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'press:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update blog posts.';

    /**
     * Execute the console command.
     *
     * @param \topolski\Press\Repositories\PostRepository $postRepository
     *
     * @return mixed
     */
    public function handle(PostRepository $postRepository)
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            $this->info('Number of Posts: ' . count($posts));

            foreach ($posts as $post) {
                $postRepository->save($post);

                $this->info('Post: ' . $post['title']);
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}