<?php

namespace App\Services\Search;

class SearchKeywordMap
{
    /**
     * Maps intent keywords (Arabic + English) to model types.
     * Each key is a type, value is an array of trigger words.
     */
    public static array $intentMap = [
        'hotel' => [
            'فندق', 'فنادق', 'نزل', 'استراحة', 'hotel', 'hotels', 'resort', 'lodge',
        ],
        'car' => [
            'عربية', 'عربيات', 'سيارة', 'سيارات', 'ايجار عربية', 'تأجير سيارة',
            'car', 'cars', 'vehicle', 'rental car', 'rent a car',
        ],
        'restaurant' => [
            'مطعم', 'مطاعم', 'أكل', 'طعام', 'restaurant', 'restaurants', 'food', 'eat',
        ],
        'activity' => [
            'نشاط', 'أنشطة', 'رحلة', 'جولة', 'tour', 'activity', 'activities', 'trip',
        ],
    ];

    /**
     * Returns the detected type and cleaned keywords from a query.
     * e.g. "عايز فندق في القاهرة" → ['detected_type' => 'hotel', 'keywords' => ['فندق', 'القاهرة']]
     */
    public static function analyze(string $query): array
    {
        $query     = self::normalize($query);
        $words     = preg_split('/[\s،,]+/u', $query, -1, PREG_SPLIT_NO_EMPTY);
        $detected  = null;
        $stopWords = self::stopWords();

        foreach (self::$intentMap as $type => $triggers) {
            foreach ($triggers as $trigger) {
                // Support multi-word triggers like "ايجار عربية"
                if (mb_strpos($query, $trigger) !== false) {
                    $detected = $type;
                    break 2;
                }
            }
        }

        // Remove stop words + intent trigger words, keep meaningful keywords
        $allTriggers = array_merge(...array_values(self::$intentMap));
        $keywords    = array_filter($words, function ($w) use ($stopWords, $allTriggers) {
            return mb_strlen($w) > 1
                && ! in_array($w, $stopWords)
                && ! in_array($w, $allTriggers);
        });

        // If nothing meaningful left, fallback to full query
        if (empty($keywords)) {
            $keywords = $words;
        }

        return [
            'detected_type' => $detected,
            'keywords'      => array_values($keywords),
            'original'      => $query,
        ];
    }

    public static function normalize(string $query): string
    {
        $query = mb_strtolower(trim($query));
        // Normalize Arabic alef variants
        $query = str_replace(['أ', 'إ', 'آ', 'ٱ'], 'ا', $query);
        // Remove tashkeel (diacritics)
        $query = preg_replace('/[\x{064B}-\x{065F}]/u', '', $query);
        return $query;
    }

    private static function stopWords(): array
    {
        return [
            // Arabic
            'عايز', 'عاوز', 'ابغى', 'أبغى', 'أريد', 'اريد', 'بدي', 'محتاج', 'محتاجة',
            'في', 'من', 'الى', 'إلى', 'عن', 'على', 'مع', 'هل', 'هناك', 'فيه',
            'ايه', 'إيه', 'احسن', 'أحسن', 'افضل', 'أفضل', 'كويس', 'رخيص', 'قريب',
            // English
            'i', 'want', 'need', 'looking', 'for', 'find', 'a', 'an', 'the',
            'in', 'near', 'best', 'good', 'cheap', 'any',
        ];
    }
}
