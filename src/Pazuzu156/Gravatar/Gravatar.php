<?php

namespace Pazuzu156\Gravatar;

/**
 * Generates a Gravatar URL and Image.
 */
class Gravatar
{
    /**
     * Instance of a user avatar.
     *
     * @var \Pazuzu156\Gravatar\Avatar
     */
    public $avatar = null;

    /**
     * Instance of a user profile.
     *
     * @var \Pazuzu156\Gravatar\Profile
     */
    public $profile = null;

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
    const BASE_HTTP = 'http://www.gravatar.com/';

    /**
     * The Base URL for the secure URL.
     *
     * @var string
     */
    const BASE_HTTPS = 'https://secure.gravatar.com/';

    /**
     * Class constructor.
     *
     * @param int  $defaultSize - The default size of the image
     * @param bool $secure      - Use the secure base URL or not
     *
     * @return void
     */
    public function __construct($defaultSize = 500, $secure = true)
    {
        // Create avatar/profile instances
        $this->avatar = new Avatar($this);
        $this->profile = new Profile($this);

        $this->setSize($defaultSize);

        $this->_options['secure'] = $secure;

        // set defaults that cannot be set here,
        // but can be upon generation request
        $this->setImageSet($this->_const('MM'));
        $this->setRating($this->_const('G'));
    }

    /**
     * Gets a constant. Use when $obj->avatar()::CONSTANT doesn't work (support function).
     *
     * @param string $constant - The constant to load
     *
     * @return mixed
     */
    public function _const($constant)
    {
        return constant(get_class($this->avatar).'::'.$constant);
    }

    /**
     * Returns the Avatar instance.
     *
     * @return \Pazuzu156\Gravatar\Avatar
     */
    public function avatar()
    {
        return $this->avatar;
    }

    /**
     * Returns the Profile instance.
     *
     * @return \Pazuzu156\Gravatar\Profile
     */
    public function profile()
    {
        return $this->profile;
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
     * @param string $imgset - The image set to use
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setImageSet($imgset)
    {
        $this->_options['d'] = $imgset;

        return $this;
    }

    /**
     * Sets the requested max rating of the image.
     *
     * @param string $rating - The rating to use
     *
     * @return \Pazuzu156\Gravatar\Gravatar
     */
    public function setRating($rating)
    {
        $this->_options['r'] = $rating;

        return $this;
    }

    /**
     * Gets the email set in the Gravatar options.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_options['email'];
    }

    /**
     * Gets the size set in the Gravatar options.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->_options['s'];
    }

    /**
     * Gets the image set set in the Gravatar options.
     *
     * @return int
     */
    public function getImageSet()
    {
        return $this->_options['d'];
    }

    /**
     * Gets the rating set in the Gravatar options.
     *
     * @return string
     */
    public function getRating()
    {
        return $this->_options['r'];
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
     * Generates the Gravatar URL.
     *
     * @param string $type  - [avatar|profile] Get the requested user item
     * @param string $email - The user's email
     * @param array  $attr  - Extra attributes to set for the image request
     *
     * @throws \Exception
     *
     * @return string
     */
    public function generateUrl($type, $email, array $attr = [])
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

        $base = (($this->_options['secure']) ? self::BASE_HTTPS : self::BASE_HTTP);

        switch (strtolower($type)) {
        case 'avatar':
            $url = $base.'avatar/';
            break;
        case 'profile':
            $url = $base;
            break;
        default:
            throw new \Exception('Invalid URL type given! Must be avatar or profile!');
        }

        return $url.$this->getHash();
    }
}
