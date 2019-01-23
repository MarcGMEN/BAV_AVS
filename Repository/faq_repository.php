<?php
/**
 * retourne les marques dans la liste des object
 */

function getAllFaq()
{
    return getAll("bav_faq", "faq_id");
}

function getOneFaq($id)
{
    return getOne($id, "bav_faq", "faq_id");
}

function updateFaq($obj)
{
    return update("bav_faq", $obj, "faq_id");
}

function insertFaq($obj)
{
    return insert("bav_faq", $obj);
}

function deleteFaq($id)
{
    return delete("bav_faq", $id, "faq_id");
}

function getFaqs($selection, $approved = null)
{
    $requete2 = "SELECT * from bav_faq where 1 = 1 ";
    if ($selection && $selection != "") {
        $requete2 .= " and (faq_question like '%$selection%' " ;
        $requete2 .= " or faq_response like '%$selection%' )" ;
    }
    if ($approved != null) {
        $requete2 .= " and faq_approved = $approved ";
    }
    $requete2 .= " order by faq_date desc";
    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getFaqs' [$requete2]".mysqli_error());
    }
    return $tab;
}
