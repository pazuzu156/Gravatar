<?php

namespace Pazuzu156\Gravatar\ImageSet;

/**
 * IImage interface is used as the PHP version of an enum.
 */
interface IImage
{
    // Image sets
    const NOT_FOUND = 0;
    const MM = 1;
    const ICON = 2;
    const MONSTER = 3;
    const WAVATAR = 4;

    // Ratings
    const LOWEST = 5;
    const LOW = 6;
    const HIGH = 7;
    const HIGHEST = 8;
}
