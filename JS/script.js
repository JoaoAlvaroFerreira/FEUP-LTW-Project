//selects the number of votes of all posts
let votes = document.querySelectorAll('span[id=votes]');
//selects the id of all posts
let id = document.querySelectorAll('span[class=id]');
//selects the upvote button of all posts
let upvote = document.querySelectorAll('input[value=Upvote]');
//selects the downvote button of all posts
let downvote = document.querySelectorAll('input[value=Downvote]');
//selects the number of votes of all comments
let votesCom = document.querySelectorAll('span[id=votesCom]');
//selects the upvote button of all comments
let upvoteCom = document.querySelectorAll('div[id=comment_votes] input[value=Upvote]');
//selects the downvote button of all comments
let downvoteCom = document.querySelectorAll('div[id=comment_votes] input[value=Downvote]');
//selects the id of all comments
let idCom = document.querySelectorAll('span[class=commentid]');
//number to add on the number of votes of a comment or post (upvote = 1/downvote = -1)
let number;
for(let i=0;i<upvoteCom.length;i++){
  /**
   * eventlistner when the user clicks on button upvote of a comment
   */
  upvoteCom[i].addEventListener('click', function() {
    number=1;
    createRequestCom(1)
    
  });
  
  
  /**
   * eventlistner when the user clicks on button downvote of a comment
   */
  downvoteCom[i].addEventListener('click', function() {
    number=-1;
    createRequestCom(0)
  });

  /**
   * creates the request with ajax and sends to api of comments
   * the id of the comment and if is a positive vote or not
   * @param {integer} positive 
   */
  function createRequestCom(positive){
    let request = new XMLHttpRequest();
    request.open("post", "../api/api_vote_comments.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', receiveVoteResponseCom);
    request.send(encodeForAjax({com_id: parseInt(idCom[i].textContent),positive: positive}));
  };
  
  /**
   *Handles all the responses of api of comments
   *
   */
  function receiveVoteResponseCom(event){
    let resp = JSON.parse(this.responseText);
    //when the user is not logged in
      if(resp == "not_logged_in"){
        alert("You need to be logged in to vote.");
      }
      //when the user hasn't already voted on a certain comment, adds the value of number to the number of votes
      if(resp == "new_vote"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)+ number;
      }
      //when the user has already a vote on a certain comment with the same value, subtracts the number to the number of votes
      //like if he has a upvote and clicks upvote again
      if(resp == "take_out"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)- number;
      }
      //when the user has already a vote on a certain comment with different value, adds 2 times the number to the number of votes
      //like if he has a upvote and clicks downvote
      if(resp == "dif_vote"){
        votesCom[i].innerHTML=parseInt(votesCom[i].textContent)+(2*number);
      }
  };
  
};

for(let i=0;i<upvote.length;i++){
  /**
   * eventlistner when the user clicks on button upvote of a post
   */
  upvote[i].addEventListener('click', function() {
    number=1;
    createRequest(1)
    
  });
  
  
  /**
   * eventlistner when the user clicks on button downvote of a post
   */
  downvote[i].addEventListener('click', function() {
    number=-1;
    createRequest(0)
  });
  
  /**
   * creates the request with ajax and sends to api of posts
   * the id of the posts and if is a positive vote or not
   * @param {integer} positive 
   */
  function createRequest(positive){
    let request = new XMLHttpRequest();
    request.open("post", "../api/api_vote_posts.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', receiveVoteResponse);
    request.send(encodeForAjax({post_id: parseInt(id[i].textContent),positive: positive}));
  };
  
  /**
   *Handles all the responses of api of posts
   *
   */
  function receiveVoteResponse(event){
    let resp = JSON.parse(this.responseText);
      //when the user is not logged in
      if(resp == "not_logged_in"){
        alert("You need to be logged in to vote.");
      }
      //when the user hasn't already voted on a certain post, adds the value of number to the number of votes
      if(resp == "new_vote"){
      votes[i].innerHTML=parseInt(votes[i].textContent)+ number;
      }
      //when the user has already a vote on a certain post with the same value, subtracts the number to the number of votes
      //like if he has a upvote and clicks upvote again
      if(resp == "take_out"){
        votes[i].innerHTML=parseInt(votes[i].textContent)- number;
      }
      //when the user has already a vote on a certain post with different value, adds 2 times the number to the number of votes
      //like if he has a upvote and clicks downvote
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