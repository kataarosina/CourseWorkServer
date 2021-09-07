<?php

include_once(ROOT.'/components/db.php');

class Articles
{

    /**
     *  This function sends a request to database and gets a response with one article
     * @param $id
     * @return mixed
     */
    public static function getArticleById($id): mixed
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('SELECT header, file_name FROM articles WHERE id = :id');
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. And returning result
        return $result->fetch();
    }

    /**
     *  This function sends a request to database and gets a response with all of articles
     * @return array
     */
    public static function getAllArticles(): array
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('SELECT id, header, description FROM articles ORDER BY id');
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Forming the articles list
        $i = 0;
        $articlesList = array();
        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['header'] = $row['header'];
            $articlesList[$i]['description'] = $row['description'];
            $i++;
        }

        // 4. And return it
        return $articlesList;
    }

    /**
     *  This function processing the entered new article data and save it in DB
     * @param $header
     * @param $description
     * @param $text
     * @return bool
     */
    public static function createNewArticle($header, $description, $text): bool
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Getting last id
        $result = $db->prepare('SELECT id FROM articles ORDER BY id DESC LIMIT 1');
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $id = $result->fetch();
        if ($id === false) $id = 1;
        else $id = $id['id'] +  1;

        // 3. Processing data
        $pattern = "~{!![0-9]+!!}~";
        if (isset($_FILES['images'])) {
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                $replacement = '<div style="text-align: center; margin-top: 5px; margin-bottom: 5px"><img src="../../static/articlesStorage/images/article_' . $id . '_' . $i . '.jpeg" style="width: 50%"></div>';
                $text = preg_replace($pattern, $replacement, $text, 1);
            }
        }
        $replace = "\n";
        $replace_to = "\n".'<br>';
        $text = str_replace($replace, $replace_to, $text);
        $i = 0;
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $img) {
                $name = 'article_' . $id . '_' . $i . '.jpeg';
                move_uploaded_file($img, ROOT . '/static/articlesStorage/images/' . $name);
                $i++;
            }
        }
        $path_to_text = ROOT.'/static/articlesStorage/texts/text_'.$id.'.txt';
        $fp = fopen($path_to_text, 'w');
        fwrite($fp, $text);
        fclose($fp);
        $path_to_text = 'text_'.$id.'.txt';

        // 4. Forming MySQL request
        $result = $db->prepare('INSERT INTO articles (id, header, description, file_name) VALUES
        (:id, :header, :description, :path_to_text)');
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':header', $header, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':path_to_text', $path_to_text, PDO::PARAM_STR);
        $result->execute();

        // 5. Return true
        return true;
    }

    /**
     *  This function deletes the article
     * @param $id
     * @return bool
     */
    public static function deleteArticle($id): bool
    {
        // 1. Deleting files
        $fp = fopen(ROOT.'/static/articlesStorage/texts/text_'.$id.'.txt', 'r');
        $text = fread($fp, 100000000);
        fclose($fp);
        unlink(ROOT.'/static/articlesStorage/texts/text_'.$id.'.txt');
        $img_files = array();
        $pattern = '~article_[0-9]+_[0-9]+\.jpeg~';
        preg_match_all($pattern, $text, $img_files);
        foreach ($img_files[0] as $key=>$value) {
            unlink(ROOT.'/static/articlesStorage/images/'.$value);
        }

        // 2. Getting connection with DB
        $db = DB::connectToDB();

        // 3. Forming MySQL request
        $result = $db->prepare('DELETE FROM articles WHERE id = :id');
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        // 4. Return true
        return true;
    }
}