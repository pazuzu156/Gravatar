<?php

namespace Pazuzu156\Gravatar;

/**
 * Handles the user's Profile.
 */
class Profile
{
    /**
     * Gravatar master class instance.
     *
     * @var \Pazuzu156\Gravatar\Gravatar
     */
    private $_gravatar = null;

    /**
     * Holds the profile data in raw format.
     *
     * @var string
     */
    private $_data = null;

    /**
     * Class constructor.
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
     * Sets the email for getting profile info
     * This is optional if you made a previous call
     * to the master Gravatar class and are using it to get
     * data from here.
     *
     * @param string $email - The email to set
     *
     * @return \Pazuzu156\Gravatar\Profile
     */
    public function setEmail($email)
    {
        $this->_gravatar->setEmail($email);

        return $this;
    }

    /**
     * Returns raw, serialized profile data.
     *
     * @return string
     */
    public function getRaw()
    {
        $url = $this->_gravatar->generateUrl('profile', $this->_gravatar->getEmail()).'.php';

        if (is_null($this->_data)) {
            $this->_data = file_get_contents($url);
        }

        return $this->_data;
    }

    /**
     * Gets the profile data in array format.
     *
     * @return array
     */
    public function getData()
    {
        return unserialize($this->getRaw());
    }

    /**
     * Gets the data and returns it as an stdClass.
     *
     * @param string $email - If email is not set or want a different one
     *
     * @return \stdClass
     */
    public function get($email = '')
    {
        if (!empty($email)) {
            $this->setEmail($email);
        }

        return $this->toObject();
    }

    /**
     * Returns the data as a JSON string.
     *
     * @return string
     */
    public function toJson()
    {
        return @json_encode($this->toArray());
    }

    /**
     * Converts the data into whichever type specified.
     *
     * @param string $type - [array/object] Convert into a given type
     * @param mixed  $data - The data to convert
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function convert($type, $data)
    {
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $data[$k] = $this->convert($type, $v);
            }
        }

        switch (strtolower($type)) {
        case 'array':
            return (array) $data;
            break;
        case 'object':
            return (object) $data;
            break;
        default:
            throw new \Exception('Invalid conversion type given!');
        }
    }

    /**
     * Quickly gets the data in stdClass format.
     *
     * @return \stdClass
     */
    public function toObject()
    {
        return $this->convert('object', $this->getData()['entry'][0]);
    }
}
