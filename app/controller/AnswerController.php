<?php
 /*
 * File: AnswerController.php
 * Category: -
 * Author: MSG
 * Created: 09.10.14 22:20
 * Updated: -
 *
 * Description:
 *  -
 */

  class AnswerController extends AppController{

      public function create(){
          if(!empty($this->data['post'])) {
              $_POST['date_created'] = time();
              $answer = new Answer($this->data['post']);
              $answer->save();
              Helper::routRedirect('index',array('route'=>'questions','method'=>'update','question_id'=>$answer->question->id));
          } else {
              $data['question'] = Question::find($this->data['get']['question_id']);
          }
          return $data;
      }

      public function update() {
          if(!empty($this->data['post'])) {
              $params = $this->data['post'];
              $answer = Answer::find($params['id']);
              unset($params['id']);
              $answer->update_attributes($params);
              Helper::routRedirect('index',array('route'=>'questions','method'=>'update','question_id'=>$answer->question->id));
          } else {
              $data['answer'] = Answer::find($this->data['get']['answer_id']);
          }
          return $data;
      }
  }

?>