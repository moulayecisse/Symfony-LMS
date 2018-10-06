<?php

namespace App\Twig;

use App\Entity\LikeNotification;
use App\Entity\Book\Book;
use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class AppExtension.
 */
class AppExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var string
     */
    private $locale;

    /**
     * AppExtension constructor.
     *
     * @param string $locale
     */
    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('filter_pbooks', [$this, 'filterPBooks']),
        ];
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('status', [$this, 'statusFilter']),
            new TwigFilter('time_elapsed_string', [$this, 'timeElapsedString']),
        ];
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return [
            'locale' => $this->locale,
        ];
    }

    /**
     * @param $status
     *
     * @return string
     */
    public function statusFilter($status)
    {
        return '<span>'.$status.'</span>';
    }

    /**
     * @return array|\Twig_Test[]
     */
    public function getTests()
    {
        return [
            new \Twig_SimpleTest(
                'like',
                function ($obj) {
                    return $obj instanceof LikeNotification;
                }
                ),
        ];
    }

    /**
     * Filter PBooks according to there status.
     *
     * @param \App\Entity\Book\Book[] $pbooks array of pbooks to filter
     *
     * @return array
     */
    public function filterPBooks($pbooks): array
    {
        $pbookInside = [];
        $pbookOutside = [];
        $pbookReserved = [];
        $pbookNotAvailable = [];

        /*
         * @var Book
         */
        foreach ($pbooks as $pbook) {
            if (in_array(Book::STATUS_INSIDE, $pbook->getStatus())) {
                /* @var Book[] $pbookInsides pbooks that is inside */
                /* @var array $pbookInsides pbooks that is inside */
                $pbookInsides[] = $pbook;
            }

            if (in_array(Book::STATUS_OUTSIDE, $pbook->getStatus())) {
                $pbookOutside[] = $pbook;
            }

            if (in_array(Book::STATUS_RESERVED, $pbook->getStatus())) {
                $pbookReserved[] = $pbook;
            }

            if (in_array(Book::STATUS_NOT_AVAILABLE, $pbook->getStatus())) {
                $pbookNotAvailable[] = $pbook;
            }
        }

        return [
            'insides_pbooks' => $pbookInside,
            'outside_pbooks' => $pbookOutside,
            'reserved_pbooks' => $pbookReserved,
            'not_available_pbooks' => $pbookNotAvailable,
        ];
    }

    /**
     * @param DateTime $datetime
     * @param bool     $full
     *
     * @return string
     */
    public function timeElapsedString($datetime, $full = false)
    {
        $now = new DateTime();
//        $ago = new DateTime($datetime);
        $ago = $datetime;
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k.' '.$v.($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string).' ago' : 'just now';
    }
}
