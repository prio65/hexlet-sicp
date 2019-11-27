<?php

use Illuminate\Support\Collection;

if (!function_exists('getChapterName')) {
    function getChapterName(string $chapter): string
    {
        return  __('sicp.chapters')[$chapter];
    }
}

if (!function_exists('haveRead')) {
    function haveRead(App\User $user, App\Chapter $chapter)
    {
        return $user->chapters->contains($chapter);
    }
}

if (!function_exists('getChapterHeaderTag')) {
    function getChapterHeaderTag(App\Chapter $chapter): string
    {
        return $chapter->can_read
        ? ''
        : sprintf('h%s', $chapter->getChapterLevel() + 3);
    }
}
if (!function_exists('getReadChapterPercent')) {
    function getReadChapterPercent($readChapters, $chapters)
    {
        if ($chapters->count() === 0) {
            return 0;
        }
        return ($readChapters->count() / $chapters->count()) * 100;
    }
}
if (!function_exists('buildChaptersTreeFromStructure')) {
    function buildChaptersTreeFromStructure(Collection $chapters)
    {
        $chaptersNew = [];
        for ($i = 0, $c = count($chapters); $i < $c; $i++) {
            $parent_id = $chapters[$i]['parent_id'];
            $parent_id = $parent_id ? $parent_id : 0;
            $chaptersNew[$parent_id][] = $chapters[$i];
        }
        return $chaptersNew;
    }
}
