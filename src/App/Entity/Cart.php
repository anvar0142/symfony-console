<?php


namespace Console\App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="Cart")
 */
class Cart
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $user_id;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $sended;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get sended
     *
     * @return boolean
     */
    public function getSended()
    {
        return $this->sended;
    }


    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Cart
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Cart
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Set price
     *
     * @param boolean $sended
     *
     * @return Cart
     */
    public function setSended($sended)
    {
        $this->sended = $sended;
        return $this;
    }

    /**
     * Set user_id
     *
     * @param integer $user_id
     *
     * @return Cart
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }


}