<?php

namespace Pazuzu156\Gravatar;

/**
 * Handles the user's Avatar.
 */
class Avatar
{
    /**
     * Loads a 404 error instead of an image if none is found with given hash.
     *
     * @var string
     */
    const NOT_FOUND = '404';

    /**
     * Loads in the (mystery man) image if none is found with given hash.
     *
     * @var string
     */
    const MM = 'mm';

    /**
     * Loads in a geometric pattern if none is found with given hash.
     *
     * @var string
     */
    const ICON = 'identicon';

    /**
     * Loads in monster image if none is found with given hash.
     *
     * @var string
     */
    const MONSTER = 'monsterid';

    /**
     * Loads in funky faces images if none is found with given hash.
     *
     * @var string
     */
    const WAVATAR = 'wavatar';

    /**
     * Loads in an 8-bit arcade-style image if none is found with given hash.
     *
     * @var string
     */
    const RETRO = 'retro';

    /**
     * Loads in nothing (transparent image) if none is found with given hash.
     *
     * @var string
     */
    const BLANK = 'blank';

    /**
     * G is suitable for all sites and ages.
     *
     * @var string
     */
    const G = 'g';

    /**
     * PG contains mild offences such as rude gestures or light language.
     *
     * @var string
     */
    const PG = 'pg';

    /**
     * R contains harsh language, violence, nudity and/or use of drugs.
     *
     * @var string
     */
    const R = 'r';

    /**
     * X contains pornographic imagery and/or extream violence.
     *
     * @var string
     */
    const X = 'x';

    /**
     * Gravatar master class instance.
     *
     * @var \Pazuzu156\Gravatar\Gravatar
     */
    private $_gravatar = null;

    /**
     * Class constructor
     *
     * @param \Pazuzu156\Gravatar\Gravatar $gravatar
     *
     * @return void
     */
    public function __construct(Gravatar $gravatar)
    {
        $this->_gravatar = $gravatar;
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
        return $this->_gravatar->generateUrl('avatar', $email, $attr);
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
    public function img($email = '', $alt = '', array $attr = [])
    {
        if (empty($email)) {
            $email = $this->_options['email'];
        }

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
