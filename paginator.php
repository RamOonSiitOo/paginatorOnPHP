/*
* Function to get all the pages we can get by 3 parameters:
*   -All de data from a Query
*   -Number of results per page
*   -Current Page we're requesting
* How works: 
*   Check if current page number is less than total pages and no 0.
*     If -> just fill everything, all the data on the current page at first index position and last page on second one
*     Else -> just fill the array with null on first index position and last page on second one
*   Returns: Array called paginationData with 2 positions (if it's filled): [[all_data_to_page],[last_page]]
**/

function getPaginationData ($data, $resultNum, $currentPage){
    //Array(paginationData) Size: 2 [[Array data], last page]
    $paginationData = array();
    $lastPage = floor(sizeof($data)/$resultNum);
    $numResultsLastPage = sizeof($data)%$resultNum;
    if($numResultsLastPage>0){
        $lastPage++;
    }
    
    if($lastPage!=0 && $lastPage>=$currentPage){
        $initialPosition = isset($currentPage) ? ($currentPage-1) * $resultNum : 0;
        $lastCounterPosition = $initialPosition+$resultNum;

        //If there is a problem here, just is because the url is manually introduced, so just resend to 0 results page and everything empty     
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
        $paginationData[0] = null;
        if($lastPage==0){
            $lastPage=1;
        }
        $paginationData[1] = $lastPage;
        return $paginationData;
    }
}
