<?php

namespace Pazuzu156\Gravatar\ImageSet;

/**
 * Trait for sifting through siftable items.
 */
trait Siftable
{
    /**
     * Sift through image sets and give the real value.
     *
     * @param int $imgset - The image set to use in integer value
     *
     * @return mixed
     */
    protected function setSift($imgset)
    {
        switch ($imgset) {
        case 0:
            return 404;
            break;
        case 1:
            return 'mm';
            break;
        case 2:
            return 'identicon';
            break;
        case 3:
            return 'monsterid';
            break;
        case 4:
            return 'wavatar';
            break;
        }
    }

    /**
     * Sift through ratings and give the real value.
     *
     * @param int $rating - The rating to use in integer value
     *
     * @return string
     */
    protected function ratSift($rating)
    {
        switch ($rating) {
        case 5:
            return 'g';
            break;
        case 6:
            return 'pg';
            break;
        case 7:
            return 'r';
            break;
        case 8:
            return 'x';
            break;
        }
    }
}
