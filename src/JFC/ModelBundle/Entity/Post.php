<?php
// src/JFC/ModelBundle/Entity/Post.php

namespace JFC\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="JFC\ModelBundle\Repository\PostRepository")
 */
class Post extends Timestampable
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, unique=false)
     * @ORM\Column(length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @return Array Collection
     *
     * @ORM\ManyToMany(targetEntity="Reply", inversedBy="post")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     * @JoinTable(name="posts_replies",
     *      joinColumns={@JoinColumn(name="post_id", referencedColumnName="id", nullable=true)},
     *      inverseJoinColumns={@JoinColumn(name="reply_id", referencedColumnName="id")}
     *      )
     */
    protected $replies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->replies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
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
     * Set category
     *
     * @param \JFC\ModelBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\JFC\ModelBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \JFC\ModelBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    

    /**
     * Add replies
     *
     * @param \JFC\ModelBundle\Entity\Reply $replies
     * @return Post
     */
    public function addReply(\JFC\ModelBundle\Entity\Reply $replies)
    {
//        $replies->addPost($this);

        $this->replies[] = $replies;

        return $this;
    }

    /**
     * Remove replies
     *
     * @param \JFC\ModelBundle\Entity\Reply $replies
     */
    public function removeReply(\JFC\ModelBundle\Entity\Reply $replies)
    {
        $this->replies->removeElement($replies);
    }

    /**
     * Get replies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Post
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
