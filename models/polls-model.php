<?php

function selectPollID($poll_id, $user_id) {
    global $conn;
    
    $res = array();
    $query = $conn->prepare("SELECT question FROM polls WHERE poll_id = :poll_id");
    $query->bindParam(":poll_id", $poll_id);
    $query->execute();
    if($query->rowCount() > 0) {
        $question = $query->fetch(PDO::FETCH_OBJ);
        $res["question"] = $question;
        // display($question);

        $query = $conn->prepare("SELECT choice_text as text, choice_id as id  FROM poll_choices WHERE poll_id = :poll_id");
        $query->bindParam(":poll_id", $poll_id);
        $query->execute();
        if($query->rowCount() > 0) {
            $answers = $query->fetchAll(PDO::FETCH_OBJ);
            $res["answers"] = $answers;
            

            $query = $conn->prepare("SELECT count(*) from poll_answers WHERE user_id = :user_id");
            $query->bindParam("user_id", $user_id);
            $query->execute();
            $voted = $query->fetch(PDO::FETCH_NUM);
            // display($voted);

            if($voted[0] > 0) {
                $res['voted'] = "1";
                $query = $conn->prepare("SELECT choice_id FROM poll_choices WHERE poll_id = :poll_id");
                $query->bindParam(":poll_id", $poll_id);
                $query->execute();
                $choices = $query->fetchAll(PDO::FETCH_OBJ);

                $choice_count = array();
                foreach($choices as $i => $choice_id) {
                    // display($choice_id->choice_id);
                    $id = $choice_id->choice_id;
                    $query = $conn->prepare("SELECT COUNT(*) FROM poll_answers WHERE choice_id = :id");
                    $query->bindParam(":id", $id);
                    $query->execute();
                    $num = $query->fetch()[0];
                    $choice_count[] = $num;

                }
                // display($choice_count);
                $res['results'] = $choice_count;

    
            }
            else {
                $res['voted'] = "0";
                // display($res);

            }

            return $res;
        }
        else {
            // error
        }
        
    }
    else {
        // error
    }

    
}



function insertPollAnswer($choice_id, $user_id) {
    global $conn;

    $query = $conn->prepare("SELECT COUNT(*) FROM poll_answers WHERE user_id = :user_id");
    $query->bindParam(":user_id", $user_id);
    $query->execute();

    // display($query);

    if($query) {
        $num = $query->fetch()[0];
        if(!$num) {
            $query = $conn->prepare("INSERT INTO poll_answers (choice_id, user_id) VALUES(:choice_id, :user_id)");
            $query->bindParam(":user_id", $user_id);
            $query->bindParam(":choice_id", $choice_id);
            $res = $query->execute();

            if($res) {
                return "Success";
            }
            else {
                //failed to insert
            }
        }
        else {
            // already voted
        }
    }
    else {
        //error
    }


}