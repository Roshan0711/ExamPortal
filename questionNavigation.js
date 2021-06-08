let quesIndex = 0;
const questions = document.querySelectorAll(".questions");
const next = document.querySelector("#next");
const prev = document.querySelector("#prev");
const buttons = document.querySelectorAll(".buttons");

showQues();

function showQues() {
  for(let ques of questions) {
    ques.style.display = "none";
  }
  questions[quesIndex].style.display = "block";
  if(quesIndex === 0) {
    prev.disabled = true;
  }
  else {
    prev.disabled = false;
  }
  if(quesIndex === questions.length - 1) {
    next.disabled = true;
  }
  else {
    next.disabled = false;
  }
}

prev.addEventListener("click", function(e) {
  e.preventDefault();
  if(quesIndex !== 0) {
    quesIndex -= 1;
    showQues();
  }
});

next.addEventListener("click", function(e) {
  e.preventDefault();
  if(quesIndex !== questions.length - 1) {
    quesIndex += 1;
    showQues();
  }
});

for(let btn of buttons) {
  btn.addEventListener("click", function() {
    quesIndex = this.value - 1;
    showQues();
  });
}