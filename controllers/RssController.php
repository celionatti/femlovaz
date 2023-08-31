<?php

namespace App\controllers;

use App\Core\Config;
use DOMDocument;
use App\models\Rss;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\models\Settings;

class RssController extends Controller
{
    public $currentUser;
    public $settings;

    public function onConstruct(): void
    {
        $this->view->setLayout('default');
        $this->settings = Settings::fetchSettings();
    }

    /**
     * @throws Exception
     */
    public function generateRSS(Request $request, Response $response)
    {
        $feedModel = new Rss();
        $blogPosts = $feedModel->getLatestBlogPosts();

        // Build the XML structure for the RSS feed
        $xml = new DOMDocument('1.0', 'UTF-8');
        $rss = $xml->createElement('rss');
        $rss->setAttribute('version', '2.0');
        $xml->appendChild($rss);

        $channel = $xml->createElement('channel');
        $rss->appendChild($channel);

        // Add channel metadata
        $title = $xml->createElement('title', $this->settings['title']);
        $channel->appendChild($title);

        $link = $xml->createElement('link', Config::get("domain"));
        $channel->appendChild($link);

        $description = $xml->createElement('description', Config::get("meta_description"));
        $channel->appendChild($description);

        $language = $xml->createElement('language', 'en');
        $channel->appendChild($language);

        // Add blog post items
        foreach ($blogPosts as $post) {
            if (!isset($post['title'], $post['thumbnail'], $post['content'], $post['created_at'], $post['topic'], $post['author'], $post['point_one'], $post['point_two'], $post['slug'])) {
                continue; // Skip this iteration if any required keys are missing
            }

            $item = $xml->createElement('item');

            $postTitle = $xml->createElement('title', $post['title']);
            $item->appendChild($postTitle);

            $postLink = $xml->createElement('link', Config::get("domain") . 'news/read?slug=' . $post['slug']);
            $item->appendChild($postLink);

            $postCategory = $xml->createElement('category', $post['topic']);
            $item->appendChild($postCategory);

            $postImage = $xml->createElement('image', $post['thumbnail']);
            $item->appendChild($postImage);

            $postAuthor = $xml->createElement('author', rtrim($post['author'], ', '));
            $item->appendChild($postAuthor);

            $postCreator = $xml->createElement('creator', rtrim($post['username'], ', '));
            $item->appendChild($postCreator);

            $postDescription = $xml->createElement('description', $post['content']);
            $item->appendChild($postDescription);

            $pubDate = $xml->createElement('pubDate', date('r', strtotime($post['created_at'])));
            $item->appendChild($pubDate);

            $channel->appendChild($item);
        }


        // Output the XML
        header('Content-Type: application/rss+xml; charset=UTF-8');
        echo $xml->saveXML();
    }
}
