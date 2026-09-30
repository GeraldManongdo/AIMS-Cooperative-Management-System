public getmemberinformation($memberId){
    // Implementation for fetching member information
    sql = "SELECT * FROM members WHERE id = :memberId";
    stmt = $this->db->prepare($sql);
}