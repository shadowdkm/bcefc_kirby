<?php
return function () {
    return page('pastor-updates')
        ->children()
        ->listed()
        ->sortBy('date', 'desc');
};
