<?php

require 'vendor/autoload.php';

/**
 * Class to handle and receive queries for finding lost items
 * from the database.
 */

class QueryPageData {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        echo 'hello';
    }

    /**
     * Sends a query matching keywords and whether the item
     * was lost or found.
     * 
     * @param lf 'lost' or 'found' classifier
     * @param keywords the keywords to look for
     * 
     * @return res a filled out html template with the relevant
     *             information
     */
    public function query($pagePath, $lf, $keywords) {
        $tmpl = $this->fillTemplate($pagePath, $db->selectFromQuery($lf, $keywordStr));
        return $tmpl;
    }

    /**
     * Fill out the template information based on what was found
     * 
     * @param res the filled out template
     */
    private function fillTemplate($templateName, $row) {
        $htmlContent = file_get_contents($templateName);
        foreach ($table as $row) {
            $htmlContent = str_replace('{dateTime}', $row['datetime'], $htmlContent);
            str_replace('{url}', $row['url'], $htmlContent);
            str_replace('{name}', $row['name'], $htmlContent);
            str_replace('{email}', $row['email'], $htmlContent);
            str_replace('{description}', $row['description'], $htmlContent);
            str_replace('{location}', $row['location'], $htmlContent);
            str_replace('{type}', $row['type'], $htmlContent);
        }
        echo $htmlContent;
        return $htmlContent;
    }
}
?>