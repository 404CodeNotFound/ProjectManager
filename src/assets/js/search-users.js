let selectedUsers = [];

function searchUsers() {
    const searchUserInput = document.getElementById('participant');
    searchUserInput.addEventListener('keyup', function(event) {
        console.log('search');    
        let resultsDiv = document.getElementById('user-results');
        resultsDiv.innerText = '';
        const pattern = event.target.value;
        if(pattern.trim()) {
            let request = new XMLHttpRequest();
            request.open("GET", `../controllers/GetUsers.php?username=${pattern}`);

            request.onload = function(e) {
                let response = request.response;
                let users = JSON.parse(response);

                for(let i = 0; i < users.length; i++) {
                    addSearchResultToDom(users[i], resultsDiv);
                }
            }

            request.send();
        }
    });
}