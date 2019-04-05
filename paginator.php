/*
* Function to get all the pages we can get by 3 parameters:
*   -All de data from a Query
*   -Number of results per page
*   -Current Page we're requesting
* How works: 
*   Check if current page number is less than total pages and no 0.
*     If -> just fill everything, if there are results, return results, if not, just empty not null.
*     Else -> just redirect to the last page that has results and RETURN null (That can helps you to know if we gonna keep the current 
*             request page or request another one to get a properly results like when you're out of index and want to go to the last page 
*             or the first one.
*   Returns: Array called paginationData with 2 positions (if it's filled): [[all_data_to_page],[last_page]]
**/

function getPaginationData ($data, $resultNum, $currentPage){
    //Array Size 2 [[Array data], last page]
    $paginationData = array();
    $lastPage = floor(sizeof($data)/$resultNum);
    $numResultsLastPage = sizeof($data)%$resultNum;
    if($numResultsLastPage>0){
        $lastPage++;
    }
    
    if($lastPage!=0 && $lastPage>=$currentPage){
        $initialPosition = isset($currentPage) ? ($currentPage-1) * $resultNum : 0;
        $lastCounterPosition = $initialPosition+$resultNum;
  
        for($i=$initialPosition;$i<$lastCounterPosition;$i++){
            if(isset($data[$i])){
                $paginationData[0][] = $data[$i];
            }else{
                break;
                }
        }
        $paginationData[1] = $lastPage;
        return $paginationData;
    }else{    
        //Last Page by default will be 1 if is not results and no more than one page on the division
        if($lastPage==0){
            $lastPage=1;
        }
        
        //Redirection to get the next request on a right url with null return
        header ("Location: ?page=".$lastPage);
        return null;
    }
}
