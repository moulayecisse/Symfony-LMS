<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 17:31.
 */

namespace App\Service\Source\Firebase;

use App\Model\Source\Firebase\Book;
use Behat\Transliterator\Transliterator;

class Firebase
{
    private $url;
    private $authentication;

    public function __construct()
    {
        $this->url = getenv('FIREBASE_DATABASE_URL');
        $this->authentication = getenv('FIREBASE_AUTHENTICATION_KEY');
    }

    public function saveCategory(Category $category = null, $path = '/category/')
    {
        // Data for PATCH
        // Matching nodes updated
        $data = [
            'name' => $category->getName() ?? '',
        ];
        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();
        $categorySlug = Transliterator::transliterate($category->getName());
        $value = $this->url.$path.$categorySlug.'.json?auth='.$this->authentication;
        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $value);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        // Delete
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_DELETE );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
        // Get return value
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Make request
        // Close connection
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function saveSubCategory(SubCategory $subCategory = null, $path = '/sub_category/')
    {
        // Data for PATCH
        // Matching nodes updated
        $data = [
            'name' => $subCategory->getName() ?? '',
            'link' => $subCategory->getLink() ?? '',
        ];
        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();
        $subCategorySlug = Transliterator::transliterate($subCategory->getName());
        $value = $this->url.$path.$subCategorySlug.'.json?auth='.$this->authentication;
        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $value);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        // Delete
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_DELETE );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
        // Get return value
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Make request
        // Close connection
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function getBooks($path = '/book'): array
    {
        // Data for PATCH
        // Matching nodes updated
//        $data = [];
        // JSON encoded
//        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();
        $url = $this->url.$path.'.json?auth='.$this->authentication;
        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // Make request
        // Close connection
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        $books = [];
        foreach ($response as $isbn => $value) {
            if (
                isset($value['author']) && !empty($value['author'])
                && isset($value['title']) && !empty($value['title'])
                && isset($value['image'])
                && isset($value['price_new'])
                && isset($value['price_used'])
                && isset($value['url'])
            ) {
                $books[] = ( new Book() )
                    ->setAuthor($value['author'])
                    ->setImage($value['image'])
                    ->setPriceNew($value['price_new'])
                    ->setPriceUsed($value['price_used'])
                    ->setResume($value['resume'])
//                    ->setSubCategory($value['resume'])
                    ->setTitle($value['title'])
                    ->setUrl($value['url'])
                    ->setIsbn($isbn)
                ;
            }
        }

        return $books;
    }
}
