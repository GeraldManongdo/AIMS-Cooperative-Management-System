getmemberinformation($memberId) {
    // Implementation for fetching member information
 Get member inforamtion()
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':memberId', $memberId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}