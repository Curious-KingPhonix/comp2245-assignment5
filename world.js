// Copyright 2022 Kyle King
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//     http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

function remove_tags(str) {
    if ((str===null) || (str==='')) return false;
    else str = str.toString();
    return str.replace( /(<([^>]+)>)/ig, '');
}

let httpRequest;

window.onload = (evt) => {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = (e) =>{
        if( httpRequest.readyState == XMLHttpRequest.DONE){
            if(httpRequest.status == 200 ){
                console.log(httpRequest.responseText);
                document.getElementById('result').innerHTML = httpRequest.responseText;
            } else {
                throw console.error()
            }
        }
    }
    document.getElementById("lookup").onclick = (e) =>{
        const qt = document.getElementById('query').checked
        const search_request = remove_tags(document.getElementById('search').value)
        const queryParams = {
            "table" : (qt?'cities':'countries'),
            "search" : search_request
        }
        const request_url = `world.php?table=${queryParams.table}&search=${queryParams.search}`
        httpRequest.open('GET',request_url)
        httpRequest.send(null)
    }
    document.getElementById('search').onclick = (e) => {
        
    }
}