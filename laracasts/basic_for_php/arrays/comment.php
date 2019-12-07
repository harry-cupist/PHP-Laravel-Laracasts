<?php

class Comment
{
    public $title;

    public $author;

    public $published;

    public function __construct($title, $author, $published) {
        $this->title = $title;
        $this->author = $author;
        $this->published = $published;
    }

}

$comments = [
    new Comment('1st comment', 'harry', true),
    new Comment('2nd comment', 'ron', false),
    new Comment('3rd comment', 'simon', false),
    new Comment('4th comment', 'beejay', true),
    new Comment('5th comment', 'harry', true),
];


# array_filter array_map, array_column

$unpublishedComments = array_filter($comments, function($comment){
    return ! $comment->published;

});

//var_dump($unpublishedComments);

$publishedComments = array_filter($comments, function($comment){
    return $comment->published;
});

//var_dump($publishedComments);

$authorNameIsHarry = array_filter($comments, function($comment){
    return $comment->author === 'harry';
});

//var_dump($authorNameIsHarry);


#array_map

$modified = array_map(function($comment){
    $comment->author = 'harry';
    return $comment;

}, $comments);

//var_dump($modified);

$modified = array_map(function($comment){
    return array($comment);

}, $comments);

//var_dump($modified);


$modified = array_map(function($comment){
    return ['currentTitle'=>$comment->title];

}, $comments);

//var_dump($modified);

foreach($comments as $comment){
    $comment->published = true;

};

//var_dump($comments);

var_dump($comments);
$titles = array_column($comments, 'author', 'title');
var_dump($titles);