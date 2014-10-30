<?
$filename = basename($_FILES['audio']['name']);
if (move_uploaded_file($_FILES['audio']['tmp_name'], '/home/dan/public_html/ads/img/'.$filename)) {
    $data = array('filename' => $filename);
} else {
    $data = array('error' => 'Failed to save');
}
echo json_encode($data);
?>
