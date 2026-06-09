<?php
return function ($page) {
    $posts = collection('pastor-updates');
    return ['posts' => $posts->paginate(9)];
};
