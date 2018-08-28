<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:39.
 */

namespace App\Model\Source\Firebase;

class Book
{
    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $image = '';

    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $resume = '';

    /**
     * @var string
     */
    private $author = '';

    /**
     * @var string
     */
    private $priceNew = '';

    /**
     * @var string
     */
    private $priceUsed = '';

    /**
     * @var string
     */
    private $state = '';

    /**
     * @var string
     */
    private $isbn = '';

    /**
     * @var SubCategory
     */
    private $subCategory;

    /**
     * @return SubCategory
     */
    public function getSubCategory(): SubCategory
    {
        return $this->subCategory;
    }

    /**
     * @param SubCategory $subCategory
     *
     * @return Book
     */
    public function setSubCategory(SubCategory $subCategory): Book
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * @var BookContrib[]
     */
    private $details = [];

    /**
     * @var BookDetail[]
     */
    private $contribs = [];

    /**
     * @return string
     */
    public function getTitle(): String
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn(string $isbn): Book
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return Book
     */
    public function setTitle(String $title): Book
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): String
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return Book
     */
    public function setImage(String $image): Book
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): String
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Book
     */
    public function setUrl(String $url): Book
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getResume(): String
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     *
     * @return Book
     */
    public function setResume(String $resume): Book
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): String
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor(String $author): Book
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceNew(): String
    {
        return $this->priceNew;
    }

    /**
     * @param string $priceNew
     *
     * @return Book
     */
    public function setPriceNew(String $priceNew): Book
    {
        $this->priceNew = $priceNew;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceUsed(): String
    {
        return $this->priceUsed;
    }

    /**
     * @param string $priceUsed
     *
     * @return Book
     */
    public function setPriceUsed(String $priceUsed): Book
    {
        $this->priceUsed = $priceUsed;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): String
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return Book
     */
    public function setState(String $state): Book
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return BookContrib[]
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param BookContrib[] $details
     *
     * @return Book
     */
    public function setDetails(array $details): Book
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return BookDetail[]
     */
    public function getContribs(): array
    {
        return $this->contribs;
    }

    /**
     * @param BookDetail[] $contribs
     *
     * @return Book
     */
    public function setContribs(array $contribs): Book
    {
        $this->contribs = $contribs;

        return $this;
    }

    /**
     * @param BookContrib $detail
     */
    public function addDetail(BookContrib $detail)
    {
        $this->details[] = $detail;
    }

    /**
     * @param BookContrib $detail
     */
    public function removeDetail(BookContrib $detail)
    {
        if (false !== $key = array_search($detail, $this->details, true)) {
            array_splice($this->details, $key, 1);
        }
    }

    /**
     * @param BookDetail $contrib
     */
    public function addContrib(BookDetail $contrib)
    {
        $this->contribs[] = $contrib;
    }

    /**
     * @param BookDetail $contrib
     */
    public function removeContrib(BookDetail $contrib)
    {
        if (false !== $key = array_search($contrib, $this->contribs, true)) {
            array_splice($this->contribs, $key, 1);
        }
    }
}
