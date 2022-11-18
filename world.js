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

let htmlRequest;

window.onload = (evt) => {
    htmlRequest = new XMLHttpRequest();
    htmlRequest.onreadystatechange = (e) =>{
        if( htmlRequest.readyState == XMLHttpRequest.DONE){
            if(htmlRequest.status == 200 ){
                document.getElementById('result').innerHTML = htmlRequest.responseText;
            } else {
                // throw console.error()
            }
        }
    }
    document.getElementById("lookup").onclick = (e) =>{
        htmlRequest.open('GET',`world.php?country=${remove_tags(document.getElementById("country").value)}`)
        htmlRequest.send()
    }
}