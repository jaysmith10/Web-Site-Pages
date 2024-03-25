




function calculateTargetHeartRate(){
   const age = parseInt(document.getElementById("age").value);
    const gender = document.getElementById("gender").value;

    let targetHeartRate;
    if (gender === "male") {
        targetHeartRate = 220 - age;
    } else if(gender === "female") {
        targetHeartRate = 226 - age;
    }


    const eightyPercentTargetHeartRate = 0.8 * targetHeartRate;


    const resultElement = document.getElementById("result");
    resultElement.innerHTML = `Target heart rate : ${targetHeartRate.toFixed(2)} bpm<br> 80% of Target Heart Rate:${eightyPercentTargetHeartRate.toFixed(2)} bpm`;
    }




const timeElement=document.querySelector(".time");
const dateElement=document.querySelector(".date");

function formatTime(date){
    const hours12 = date.getHours() %12 || 12;
    const minutes = date,getMinutes();
    const isAm = date.getHours()< 12;

    return `${hours12.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")} ${isAm ? "AM" : "PM"}`;

}