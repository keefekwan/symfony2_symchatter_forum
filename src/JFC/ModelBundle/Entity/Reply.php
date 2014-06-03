<?php
// src/JFC/ModelBundle/Entity/Reply.php

namespace JFC\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use JFC\ModelBundle\Entity\Post;

/**
 * ReplyPost
 *
 * @ORM\Table(name="reply")
 * @ORM\Entity(repositoryClass="JFC\ModelBundle\Repository\ReplyRepository")
 */
class Reply extends Timestampable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="replies")
     */
    protected $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->body;
    }

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
     * Set body
     *
     * @param string $body
     * @return Reply
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Add post
     *
     * @param \JFC\ModelBundle\Entity\Post $post
     * @return Reply
     */
    public function addPost(\JFC\ModelBundle\Entity\Post $post)
    {
        $post->addReply($this);

        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \JFC\ModelBundle\Entity\Post $post
     */
    public function removePost(\JFC\ModelBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Reply
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
