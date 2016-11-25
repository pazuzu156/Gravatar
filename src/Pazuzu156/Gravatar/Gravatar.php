<?php

namespace Pazuzu156\Gravatar;

use Pazuzu156\Gravatar\ImageSet\IImage;
use Pazuzu156\Gravatar\ImageSet\Settable;

/**
 * Generates a Gravatar URL and Image.
 */
class Gravatar implements IImage
{
    use Settable;

    /**
     * The options to be used for generating the URL.
     *
     * @var array
     */
    private $_options = [];

    /**
     * The Base URL for the unsecure URL.
     *
     * @var string
     */
    const BASE_HTTP = 'http://www.gravatar.com/avatar/';

    /**
     * The Base URL for the secure URL.
     *
     * @var string
     */
    const BASE_HTTPS = 'http://secure.gravatar.com/avatar/';

    /**
     * Class constructor.
     *
     * @param int  $defaultSize - The default size of the image
     * @param bool $secure      - Use the secure base URL or not
     *
     * @return void
     */
    public function __construct($defaultSize = 200, $secure = false)
    {
        $this->setSize($defaultSize);

        $this->_options['secure'] = $secure;

        // set defaults that cannot be set here,
        // but can be upon generation request
        $this->setImageSet(self::MM);
        $this->setRating(self::LOWEST);
    }

    /**
     * Sets the email you want to use for image generation.
     *
     * @param string $email - The email to use
     *
     * @throws \Exception
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_options['email'] = $email;
            $this->_options['hash'] = strtolower(md5(trim($this->_options['email'])));
        } else {
            throw new \Exception('The email is in an invalid format!');
        }

        return $this;
    }

    /**
     * Sets the size of the image.
     *
     * @param int $size - The size of the image
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setSize($size)
    {
        $this->_options['s'] = $size;

        return $this;
    }

    /**
     * Sets the requested image set.
     *
     * @param int $imgset - The image set to use
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setImageSet($imgset)
    {
        $this->_options['d'] = $this->setSift($imgset);

        return $this;
    }

    /**
     * Sets the requested max rating of the image.
     *
     * @param int $rating
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setRating($rating)
    {
        $this->_options['r'] = $this->ratSift($rating);

        return $this;
    }

    /**
     * Returns the MD5 hash of the email used.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->_options['hash'];
    }

    /**
     * Generates and returns the full URL.
     *
     * @param string $email - The email to use
     * @param array  $attr  - Extra attributes to set for the image request
     *
     * @return string
     */
    public function src($email, array $attr = [])
    {
        if (!empty($email)) {
            $this->setEmail($email);
        }

        if (isset($attr['size'])) {
            $this->setSize($attr['size']);
        }

        if (isset($attr['imgset'])) {
            $this->setImageSet($attr['imgset']);
        }

        if (isset($attr['rating'])) {
            $this->setRating($attr['rating']);
        }

        $uri = '?';

        $ignore = ['email', 'hash', 'secure'];
        foreach ($this->_options as $k => $v) {
            if (!in_array($k, $ignore)) {
                $uri .= $k.'='.$v.'&';
            }
        }

        $uri = rtrim($uri, '&');
        $url = (($this->_options['secure']) ? self::BASE_HTTPS : self::BASE_HTTP).$this->getHash();

        return $url.$uri;
    }

    /**
     * Generates and returns the HTML image.
     *
     * @param string $email - The email to use
     * @param string $alt   - The alternative text for the image tag
     * @param array  $attr  - Extra attributes to set for the image request
     *
     * @return string
     */
    public function img($email, $alt = '', array $attr = [])
    {
        $img = '<img src="'.$this->src($email, $attr).'"';

        if (!empty($alt)) {
            $img .= ' alt="'.$alt.'"';
        }

        if (isset($attr['width'])) {
            $img .= ' width="'.$attr['width'].'"';
        }

        if (isset($attr['height'])) {
            $img .= ' height="'.$attr['height'].'"';
        }

        return $img.'>';
    }
}
