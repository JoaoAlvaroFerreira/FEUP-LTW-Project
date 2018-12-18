let votes = document.querySelectorAll('span[id=votes]');
let id = document.querySelectorAll('span[class=id]');
let upvote = document.querySelectorAll('input[value=Upvote]');
let downvote = document.querySelectorAll('input[value=Downvote]');
let votesCom = document.querySelectorAll('span[id=votesCom]');
let upvoteCom = document.querySelectorAll('div[id=comment_votes] input[value=Upvote]');
let downvoteCom = document.querySelectorAll('div[id=comment_votes] input[value=Downvote]');
let idCom = document.querySelectorAll('span[class=commentid]');
console.log(upvote);
let number;
for(let i=0;i<upvoteCom.length;i++){
  upvoteCom[i].addEventListener('click', function() {
    // Ajax request
    number=1;
    createRequestCom(1)
    
  });
  
  
  
  downvoteCom[i].addEventListener('click', function() {
    number=-1;
    createRequestCom(0)
  });
  
  function createRequestCom(positive){
    let request = new XMLHttpRequest();
    request.open("post", "../api/api_vote_comments.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', receiveVoteResponseCom);
    request.send(encodeForAjax({com_id: parseInt(idCom[i].textContent),positive: positive}));
  };
  
  function receiveVoteResponseCom(event){
    let resp = JSON.parse(this.responseText);
      if(resp == "not_logged_in"){
        alert("You need to be logged in to vote.");
      }
      if(resp == "new_vote"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)+ number;
      }
      if(resp == "take_out"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)- number;
      }
      if(resp == "dif_vote"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)+(2*number);
      }
  };
  
};

for(let i=0;i<upvote.length;i++){
  upvote[i].addEventListener('click', function() {
    // Ajax request
    number=1;
    createRequest(1)
    
  });
  
  
  
  downvote[i].addEventListener('click', function() {
    number=-1;
    createRequest(0)
  });
  
  function createRequest(positive){
    let request = new XMLHttpRequest();
    request.open("post", "../api/api_vote_posts.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', receiveVoteResponse);
    request.send(encodeForAjax({post_id: parseInt(id[i].textContent),positive: positive}));
  };
  
  function receiveVoteResponse(event){
    let resp = JSON.parse(this.responseText);
      if(resp == "not_logged_in"){
        alert("You need to be logged in to vote.");
      }
      if(resp == "new_vote"){
      votes[i].innerHTML=parseInt(votes[i].textContent)+ number;
      }
      if(resp == "take_out"){
        votes[i].innerHTML=parseInt(votes[i].textContent)- number;
      }
      if(resp == "dif_vote"){
        votes[i].innerHTML=parseInt(votes[i].textContent)+(2*number);
      }
  };
  
  };

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
};