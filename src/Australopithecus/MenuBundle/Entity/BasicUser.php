<?php
namespace Australopithecus\MenuBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_basic")
 */
class Members extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Name
     * @ORM\Column(type="varchar(200)")
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}