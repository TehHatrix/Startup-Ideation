<template>
  <div class="containerSummarySurvey">
    <h1 class="header">Survey Summary</h1>
    <div class="card" v-for="(item, index) in steps" :key="index">
      <div class="content">
        <p class="questionNumber">Question {{ index + 1 }}</p>
        <p class="question">{{ appendProductNameQuestion(item.question) }}</p>
        <div
          v-if="
            item.type === 'subjective' || item.answerQuestion === 'contacts'
          "
          class="answerList"
        >
          <div
            class="answerCard"
            v-for="(answer, index) in subjectiveAnswer[index + 1]"
            :key="index"
          >
            {{ answer }}
          </div>
        </div>
        <div v-if="item.type === 'mcq' || item.type === 'hybrid'" id="q1chart">
          <apexchart
            type="pie"
            width="380"
            :options="chartOptions[index + 1]"
            :series="series[index + 1]"
          ></apexchart>
        </div>
        <div
          v-if="item.type === 'mcq' || item.type === 'hybrid'"
          class="answerList"
        >
          <div
            class="checkboxGroup"
            v-for="(item, index2) in item.answer"
            :key="index2"
          >
            <input
              class="inp-cbx"
              :id="index2"
              type="radio"
              style="display: none"
              :value="valueWithoutElement(item)"
              v-model="majorityAnswer[index + 1]"
              disabled
            />
            <label
              class="cbx"
              :for="index2"
              :class="isSelected(valueWithoutElement(item))"
              ><span
                ><svg width="12px" height="9px" viewbox="0 0 12 9">
                  <polyline points="1 5 4 8 11 1"></polyline></svg></span
              ><span>{{ valueWithoutElement(item) }}</span></label
            >
          </div>
        </div>
        <div v-if="item.answerQuestion === 'dissapointed'"> 
          <strong>Reason dissapointed</strong>
            <div
            class="answerCard"
            v-for="(answer, index) in reasonDissapoint"
            :key="index"
          >
            {{ answer }}
          </div>
          
          
            </div>
      </div>
    </div>
  </div>
</template>

<script>
import surveyApi from "@/api/surveyApi.js";
import projectApi from "@/api/projectApi.js";
export default {
  data() {
    return {
      reasonDissapoint: [],
      productName: "",
      subjectiveAnswer: {
        4: [],
        6: [],
        7: [],
        8: [],
      },
      steps: [
        {
          question: "How did you discover productName?",
          type: "hybrid",
          answerQuestion: "discover",
          answer: [
            "Search engine (e.g. Google, Yahoo!)",
            "Facebook",
            "Twitter",
            "Blog",
            "Friend or colleague",
          ],
        },
        {
          question:
            "How would you feel if you could no longer use productName?",
          type: "mcq",
          answerQuestion: "dissapointed",
          answer: [
            "Very Disappointed",
            "Somewhat Disappointed",
            "Not Disappointed",
          ],
        },
        {
          question:
            "If productName is no longer available, what would you use as an alternative?",
          answerQuestion: "alternative",
          type: "hybrid",
          answer: ["I probably wouldn’t use an alternative"],
        },
        {
          question:
            "What is the primary benefit you received from productName?",
          answerQuestion: "benefits",
          type: "subjective",
          answer: "textinput",
        },
        {
          question: "Have you recommended productName to anyone?",
          answerQuestion: "recommendAny",
          type: "mcq",
          answer: ["No", "Yes"],
        },
        {
          question:
            "What type of person do you think would benefit most from productName?",
          answerQuestion: "personBenefit",
          type: "subjective",
          answer: "textinput",
        },
        {
          question: "How can we improve productName to better meet your needs?",
          answerQuestion: "improveSuggest",
          type: "subjective",
          answer: "textinput",
        },
        {
          question:
            "Would it be okay if we followed up by email to request a clarification to one or more of your responses?",
          answerQuestion: "contacts",
        },
      ],
      series: {
        1: [],
        2: [],
        3: [],
        5: [],
      },
      chartOptions: {
        1: {
          chart: {
            width: 380,
            type: "pie",
          },
          fill: {
            type: "gradient",
          },
          noData: {
            text: "Not enough data for the chart",
            align: "center",
            verticalAlign: "middle",
            offsetX: 0,
            offsetY: 0,
            style: {
              color: "#FF3156",
              fontSize: "20px",
              fontFamily: "Poppins",
            },
          },
          //   labels: [],
          labels: [],
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        },
        2: {
          chart: {
            width: 380,
            type: "pie",
          },
          fill: {
            type: "gradient",
          },
          noData: {
            text: "Not enough data for the chart",
            align: "center",
            verticalAlign: "middle",
            offsetX: 0,
            offsetY: 0,
            style: {
              color: "#FF3156",
              fontSize: "20px",
              fontFamily: "Poppins",
            },
          },
          labels: [],
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        },

        3: {
          chart: {
            width: 380,
            type: "pie",
          },
          fill: {
            type: "gradient",
          },
          noData: {
            text: "Not enough data for the chart",
            align: "center",
            verticalAlign: "middle",
            offsetX: 0,
            offsetY: 0,
            style: {
              color: "#FF3156",
              fontSize: "20px",
              fontFamily: "Poppins",
            },
          },
          labels: [],
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        },

        5: {
          chart: {
            width: 380,
            type: "pie",
          },
          fill: {
            type: "gradient",
          },
          noData: {
            text: "Not enough data for the chart",
            align: "center",
            verticalAlign: "middle",
            offsetX: 0,
            offsetY: 0,
            style: {
              color: "#FF3156",
              fontSize: "20px",
              fontFamily: "Poppins",
            },
          },
          labels: [],
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        },
      },
      currentAnswer: {},
      majorityAnswer: {
        1: "",
        2: "",
        3: "",
        5: "",
      },
    };
  },
  methods: {
    appendProductNameQuestion(question) {
      return question.replace("productName", this.productName);
    },
    valueWithoutElement(item) {
      return item.replace("[Textbox]", "");
    },
    textBoxExist(item) {
      if (item.includes("[Textbox]")) {
        return true;
      }
      return false;
    },
    isSelected(item) {
      if (item === this.majorityQ1Answer) {
        return {
          selected: true,
        };
      }
    },
    checkMCQQuestion(answerType, questionNumber) {
      if(questionNumber === 1){
        answerType = answerType.replace('Other','').trim()
      }
      else if(questionNumber === 3){
        answerType = answerType.replace('I would use','').trim()
      }
      //If not available in label chartoption
      if (
        this.chartOptions[questionNumber].labels.includes(answerType) === false
      ) {
        //push to label and series
        this.chartOptions[questionNumber].labels.push(answerType);
        this.series[questionNumber].push(1);
        //if not available in steps[index].answer (to append to checkbox)
        if (
          this.steps[questionNumber - 1].answer.includes(answerType) === false
        ) {
          //push to steps[index].answer
          this.steps[questionNumber - 1].answer.push(answerType);
        }
        //if available
      } else {
        //just increment the series with the index of label
        let index =
          this.chartOptions[questionNumber].labels.indexOf(answerType);
        this.series[questionNumber][index]++;
      }
      const allEqual = this.series[questionNumber].every(
        (v) => v === this.series[questionNumber][0]
      );
      //If every element inside array is equal
      if (allEqual === false) {
        //Set q1 majority answer with the label based on the index of highest values of the series
        this.majorityAnswer[questionNumber] =
          this.chartOptions[questionNumber].labels[
            this.series[questionNumber].indexOf(
              Math.max.apply(null, this.series[questionNumber])
            )
          ];
      }
    },
  },
  async created() {
    let projectID = this.$route.params.projectID;
    let userAnswer = await surveyApi.getUserAnswer(projectID);
    let userArray = userAnswer.data.userAnswer;
    //Append All data
    for (let i = 0; i < userArray.length; i++) {
      //for MCQ Question 1 (Discover)
      this.checkMCQQuestion(userArray[i].discover, 1);
      //for MCQ Question 2 (dissapoint)
      this.checkMCQQuestion(userArray[i].dissapointed, 2);
      if(userArray[i].reasonDissapoint !== null){
        this.reasonDissapoint.push(userArray[i].reasonDissapoint)
      }
      //for MCQ Question 3 (alternative)
      this.checkMCQQuestion(userArray[i].alternative, 3);
      //for MCQ Question 5 (alternative)
      this.checkMCQQuestion(userArray[i].recommendAny, 5);
      // this.checkQuestion1(userArray[i].discover);
      this.subjectiveAnswer[4].push(userArray[i].benefits);
      this.subjectiveAnswer[6].push(userArray[i].personBenefit);
      this.subjectiveAnswer[7].push(userArray[i].improveSuggest);
      if (userArray[i].contacts !== "No") {
        this.subjectiveAnswer[8].push(userArray[i].contacts);
      }
    }
    //Get Product Name
    let projectData = await projectApi.getProject(projectID);
    this.productName = projectData.data.project.project_name;
  },
};
</script>

<style lang="scss" scoped>
.containerSummarySurvey{
  margin-left: 30px;
}

.selected {
  color: #8743ff;
}

.checkboxGroup {
  display: flex;
  margin: 5px;
}

.header {
  font-size: 2em;
  font-weight: bold;
}

.answerCard {
  height: auto;
  width: auto;
  margin: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 5px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: scroll;
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
}

.card {
  max-height: 350px;
  height: auto;
  width: 80%;
  margin: 20px;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 20px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: scroll;
  .content {
    display: grid;
    grid-template-areas:
      "questionNumber chart "
      "question chart"
      "answerList chart";
    margin: 12px;
  }
  #q1chart {
    margin: auto;
    grid-area: chart;
  }
  .questionNumber {
    grid-area: questionNumber;
    color: #828494;
    margin-bottom: -10px;
  }
  .question {
    grid-area: question;
    font-weight: bold;
  }
  .answerList {
    grid-area: answerList;
  }

  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
}

.cbx {
  -webkit-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
  cursor: pointer;
}

.cbx span {
  display: inline-block;
  vertical-align: middle;
  transform: translate3d(0, 0, 0);
}

.cbx span:first-child {
  position: relative;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  transform: scale(1);
  vertical-align: middle;
  border: 1px solid #b9b8c3;
  transition: all 0.2s ease;
}

.cbx span:first-child svg {
  position: absolute;
  z-index: 1;
  top: 8px;
  left: 6px;
  fill: none;
  stroke: white;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 16px;
  stroke-dashoffset: 16px;
  transition: all 0.3s ease;
  transition-delay: 0.1s;
  transform: translate3d(0, 0, 0);
}

.cbx span:first-child:before {
  content: "";
  width: 100%;
  height: 100%;
  background: #506eec;
  display: block;
  transform: scale(0);
  opacity: 1;
  border-radius: 50%;
  transition-delay: 0.2s;
}

.cbx span:last-child {
  margin-left: 8px;
}

.cbx span:last-child:after {
  content: "";
  position: absolute;
  top: 8px;
  left: 0;
  height: 1px;
  width: 100%;
  background: #b9b8c3;
  transform-origin: 0 0;
  transform: scaleX(0);
}

.cbx:hover span:first-child {
  border-color: #626263;
}

.inp-cbx:checked + .cbx span:first-child {
  border-color: #626263;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  animation: check 0.6s ease;
}

.inp-cbx:checked + .cbx span:first-child svg {
  stroke-dashoffset: 0;
}

.inp-cbx:checked + .cbx span:first-child:before {
  transform: scale(2.2);
  opacity: 0;
  transition: all 0.6s ease;
}

@keyframes check {
  50% {
    transform: scale(1.2);
  }
}
</style>