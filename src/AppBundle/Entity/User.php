<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class User extends Base
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}