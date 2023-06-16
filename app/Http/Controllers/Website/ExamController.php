<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Exam\SubmitExamRequest;
use App\Http\Resources\ExamResource;
use App\Http\Resources\QuestionResource;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Option;
use App\Models\Question;
use App\Models\StudentChoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index($classRoomId)
    {
        $exams = Exam::where('class_room_id', $classRoomId)->Status()->get();
        if ($exams) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                    'allExam' => ExamResource::collection($exams),
                ]
            ]);
        }
    }

    public function view($examId)
    {
        $exam = Exam::Status()->withCount('questions')->find($examId);
    
        $questions = Question::with('options')->where('exam_id', $exam->id)->get();

        $this->checkIfStudentOpenExamBeforeTime($exam->start_at,$exam->end_at);

        return response()->json([
            'data' => [
                'exam' => new ExamResource($exam),
                'questions' => QuestionResource::collection($questions)
            ]
        ]);

    }

    public function submitExam(SubmitExamRequest $request)
    {
          //must student see exam only one and between start , end time
        $this->checkifStudentSubmitExamBefore($request->exam_id);


        $selectedAnswers = $request->answers;
        $questions = Question::whereIn('id', array_keys($selectedAnswers))->with('options')->get();

        $totalScore = 0;

        foreach ($questions as $question) {
            $selectedOptionIds = $selectedAnswers[$question->id];
            $selectedOptionIds = array_map('intval', $selectedOptionIds);
            $correctOptionIds = $question->options->where('is_correct', 1)->pluck('id')->toArray();


            $isCorrect = 0;

            if (empty(array_diff($selectedOptionIds, $correctOptionIds))) {
                $totalScore += $question->point;
                $isCorrect = 1;
            }
            foreach ($selectedOptionIds as $_ => $optionId) {
                StudentChoice::create([
                    'student_id' => Auth::user('student')->id,
                    'exam_id' => $request->exam_id,
                    'question_id' => $question->id,
                    'option_id' => $optionId,
                    'is_correct' => $isCorrect
                ]);
            }
        }

        ExamResult::create([
            'student_id' => Auth::user('student')->id,
            'exam_id' => $request->exam_id,
            'total_score' => $totalScore
        ]);

        return response()->json([
            'message' => "Response is Submitted , Thank You"
        ]);
    }

    private function checkifStudentSubmitExamBefore($examId)
    {
            //must student see exam only one and between start , end time
            if (ExamResult::where('student_id', Auth::user('student')->id)
            ->where('exam_id', $examId)->first()) {
            return response()->json([
                'message' => 'Your Response is send before'
            ]);
        }
    }

    private function checkIfStudentOpenExamBeforeTime($startAt, $endAt)
    {
        $currentDate = date('Y-m-d H:i');
        $currentDate = date('Y-m-d H:i', strtotime($currentDate));
        $startDate = date('Y-m-d H:i', strtotime($startAt));
        $endDate = date('Y-m-d H:i', strtotime($endAt));

        if (!(($currentDate >= $startDate) && ($currentDate <= $endDate))) {
            return response()->json([
                'message' => "The exam will start $startDate and End in $endDate"
            ]);
        }
    }

}
