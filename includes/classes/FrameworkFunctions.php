<?php

class FrameworkFunctions
{

    private $con;


    public function __construct($con)
    {

        $this->con = $con;
    }

    // Getting all rows from a table
    public function getData($sql, $sql2, $pagecount, $table)
    {
        if ($pagecount == NULL) {
            $query = $this->con->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();


            $query2 = $this->con->prepare("SELECT COUNT(id) AS total FROM $table");
            $query2->execute();

            $data2 = $query2->fetch(PDO::FETCH_ASSOC);
            $count = $data2['total'];

            echo json_encode(['rows' => $data, 'count' => $count, 'response' => true]);

            // Count = 200


            return $data;
        } else {

            if ($pagecount == 1) {
                $start = 0;
            } else 
             if ($pagecount > 1) {
                $start = ((($pagecount - 1) * 10));
            }


            $query = $this->con->prepare($sql2 . $start);
            $query->execute();
            $data = $query->fetchAll();


            $query2 = $this->con->prepare("SELECT COUNT(id) AS total FROM $table");
            $query2->execute();

            $data2 = $query2->fetch(PDO::FETCH_ASSOC);
            $count = $data2['total'];

            echo json_encode(['rows' => $data, 'count' => $count, 'response' => true]);
        }
    }
    public function getCleanData($sql)
    {

        $query = $this->con->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();

        return $data;
    }


    public function getMovieData($tablename, $api, $pagenumber)
    {

        $count = 0;
        if ($pagenumber == null) {
            $query = $this->con->prepare("SELECT * FROM $tablename ORDER BY id DESC LIMIT 12 OFFSET 0");
            $query->execute();
            $data = $query->fetchAll();

            $query2 = $this->con->prepare("SELECT COUNT(id) AS total FROM $tablename");
            $query2->execute();

            $data2 = $query2->fetch(PDO::FETCH_ASSOC);
            $count = $data2['total'];
        } else {

            if ($pagenumber == 1) {
                $start = 0;
            } else 
             if ($pagenumber > 1) {
                $start = ((($pagenumber - 1) * 12));
            }


            $query = $this->con->prepare("SELECT * FROM $tablename ORDER BY id DESC LIMIT 12 OFFSET " . $start);
            $query->execute();
            $data = $query->fetchAll();
        }


        $moviedata = array();


        foreach ($data as $re) {
            $movieid = $re['movieid'];
            $file = "https://api.themoviedb.org/3/movie/$movieid?api_key=$api&language=en-US";
            $data = file_get_contents($file);
            $result = json_decode($data, true);
            $moviedata[] = array(
                'id' => $result['id'],
                'title' => $result['title'],
                'poster' => $result['poster_path'],
                'genre' => $result['genres'][0]['name'],
                'rating' => $result['vote_average']
            );
        }

        echo json_encode(['rows' => $moviedata, 'count' => $count, 'response' => true]);
        return $moviedata;
    }

    public function getTvData($tablename, $api, $pagenumber)
    {

        $count = 0;
        if ($pagenumber == null) {
            $query = $this->con->prepare("SELECT * FROM $tablename ORDER BY id DESC LIMIT 12 OFFSET 0");
            $query->execute();
            $data = $query->fetchAll();

            $query2 = $this->con->prepare("SELECT COUNT(id) AS total FROM $tablename");
            $query2->execute();

            $data2 = $query2->fetch(PDO::FETCH_ASSOC);
            $count = $data2['total'];
        } else {

            if ($pagenumber == 1) {
                $start = 0;
            } else 
             if ($pagenumber > 1) {
                $start = ((($pagenumber - 1) * 12));
            }


            $query = $this->con->prepare("SELECT * FROM $tablename ORDER BY id DESC LIMIT 12 OFFSET " . $start);
            $query->execute();
            $data = $query->fetchAll();
        }


        $tvdata = array();


        foreach ($data as $re) {
            $tvid = $re['tvid'];
            $file = "https://api.themoviedb.org/3/tv/$tvid?api_key=$api&language=en-US";
            $data = file_get_contents($file);
            $result = json_decode($data, true);

            $tvdata[] = array(
                'id' => $result['id'],
                'title' => $result['name'],
                'poster' => $result['poster_path'],
                'genre' => $result['genres'][0]['name'],
                'rating' => $result['vote_average']
            );
        }

        echo json_encode(['rows' => $tvdata, 'count' => $count, 'response' => true]);
        return $tvdata;
    }

    public function getDropdown($tablename)
    {
        $query = $this->con->prepare("SELECT * FROM $tablename");
        $query->execute();
        $data = $query->fetchAll();
        echo json_encode(['rows' => $data, 'response' => true]);
    }

    // Getting Specific row from a table
    public function getSingleData($tablename, $params)
    {

        $id = "";
        foreach ($params as $field => $value) {

            $id .= "`$field` = :$field";
        }
        $query = $this->con->prepare("SELECT * FROM $tablename WHERE $id");
        foreach ($params as $field => $value) {

            $query->bindValue(':' . $field, $value, PDO::PARAM_STR);
        };
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    // Adding Data to Database
    public function addData($table, $params, $idname)
    {
        $movieid = $params[$idname];
        $stmt = $this->con->prepare("SELECT * FROM $table WHERE $idname = $movieid");

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $dataFields = "";
            $data = "";

            foreach ($params as $field => $value) {

                $dataFields .= "`$field`,";
            }

            $dataFields = rtrim($dataFields, ", ");



            foreach ($params as $field => $value) {

                $data .= ":$field,";
            }

            $data = rtrim($data, ", ");

            $query = $this->con->prepare("INSERT INTO `$table` ($dataFields) VALUES ($data)");


            foreach ($params as $field => $value) {

                $query->bindValue(':' . $field, $value, PDO::PARAM_STR);
            };

            $response = $query->execute();
            echo json_encode(['response' => $response]);
        }
    }

    // Updating a Specific row from a table
    public function updateData($table, $params, $additionalparams)
    {
        $updateSQL = "";
        $id = "";

        foreach ($params as $field => $value) {

            $updateSQL .= "`$field` = :$field,";
        }

        foreach ($additionalparams as $field => $value) {

            $id .= "`$field` = :$field";
        }

        $updateSQL = rtrim($updateSQL, ", ");

        $query = $this->con->prepare("UPDATE `$table` SET $updateSQL WHERE $id");

        foreach ($params as $field => $value) {

            $query->bindValue(':' . $field, $value, PDO::PARAM_STR);
        };

        foreach ($additionalparams as $field => $value) {

            $query->bindValue(':' . $field, $value, PDO::PARAM_INT);
        };

        $response = $query->execute();
        echo json_encode(['response' => $response]);
    }

    // Getting Specific row from a table
    public function delData($tablename, $additionalparams)
    {

        $id = "";

        foreach ($additionalparams as $field => $value) {

            $id .= "`$field` = :$field";
        }

        $query = $this->con->prepare("DELETE FROM $tablename WHERE $id");

        foreach ($additionalparams as $field => $value) {

            $query->bindValue(':' . $field, $value, PDO::PARAM_INT);
        };

        $response = $query->execute();
        echo json_encode(['response' => $response]);
    }

    public function checkUser($params, $table)
    {

        $data = "";
        foreach ($params as $field => $value) {

            $data .= "`$field` = :$field AND ";
        }
        $data = rtrim($data, "AND ");

        $query = $this->con->prepare("SELECT * FROM $table WHERE $data");

        foreach ($params as $field => $value) {

            $query->bindValue(':' . $field, $value, PDO::PARAM_STR);
        };

        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return $row;
        }


        return true;
    }
}
