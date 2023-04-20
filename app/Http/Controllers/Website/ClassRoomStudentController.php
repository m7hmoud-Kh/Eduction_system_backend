<?php

namespace App\Http\Controllers\Website;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\AppointmentResource;
use App\Http\Requests\Website\ClassRoom\RegisterRequest;
use App\Http\Requests\Website\ClassRoom\AcceptStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Appointment;

class ClassRoomStudentController extends Controller
{
    private function getStudentObject($userId)
    {
        return  Student::find($userId);
    }

    public function registerNow(RegisterRequest $request)
    {
        $found =$this->getStudentObject(Auth('student')->user()->id)->classRoom->contains($request->classroom_id);
        if ($found) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'You Already Register in this classRoom'
            ]);
        }else {
            $classRoom = ClassRoom::find($request->classroom_id)->withCount('student')->first();

            if ($classRoom->max_capacity > $classRoom->student_count) {
                $this->getStudentObject(Auth('student')->user()->id)->classRoom()->attach([$request->classroom_id], [
                    'status' => ClassRoom::WAITING,
                ]);
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Register in Classroom Successfully'
                ]);
            }
        }

    }

    public function unsubscribe(RegisterRequest $request)
    {
        $found =$this->getStudentObject(Auth('student')->user()->id)->classRoom->contains($request->classroom_id);

        if ($found) {
            $this->getStudentObject(Auth('student')->user()->id)->classRoom()->detach($request->classroom_id);
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'unsubscribe in Classroom Successfully'
            ]);
        } else {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'You Already unsubscribe in this classRoom'
            ]);
        }
    }

    public function AcceptStudentByAssistant(AcceptStudentRequest $request)
    {
        $this->getStudentObject($request->student_id)->classRoom()->updateExistingPivot($request->classroom_id, [
            'status' => ClassRoom::REQISTERED
        ]);
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Student Registered in Classroom Successfully'
        ]);
    }

    public function AcceptAllStudentByAssistant(RegisterRequest $request)
    {
        $classRoom = ClassRoom::with('student')->find($request->classroom_id);
        $studentIds = $classRoom->student()->pluck('students.id');

        foreach ($studentIds as $studentId) {
            $classRoom->student()->updateExistingPivot($studentId, [
                'status' => ClassRoom::REQISTERED
            ]);

            $classRoomRegisteredStudent = ClassRoom::find($request->classroom_id)->withCount('student')->first();

            if ($classRoomRegisteredStudent->student_count == $classRoom->max_capacity) {
                break;
            }

        }
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'All Student Registered in Classroom Successfully'
        ]);
    }

    public function remainingStudents($classroomId)
    {
        $classRoom = ClassRoom::find($classroomId)->withCount('student')->first();

        if ($classRoom) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                    'max_capacity' => $classRoom->max_capacity,
                    'Registered' => $classRoom->student_count,
                    'RemainingStudnet' => $classRoom->max_capacity - $classRoom->student_count
                ]
            ]);
        }

    }


    public function getAllStudentInClassRoom($classroomId, $appointmentId)
    {


        $found = Attendance::where('attendance_date', date('Y-m-d'))
            ->where('class_room_id', $classroomId)
            ->where('appointment_id', $appointmentId)
            ->exists();

        if ($found) {
            $appointmentInfo = Appointment::find($appointmentId);
            $allStudentAttendanceInAppointmentIdInClassRoomId =
            Student::whereHas('classRoom', function ($query) use ($classroomId) {
                return $query
                ->where('class_rooms.id', $classroomId)
                ->where('classroom_student.status', ClassRoom::REQISTERED);
            })->whereHas('attendance', function ($query) use ($appointmentId, $classroomId) {
                return $query
                ->where('class_room_id', $classroomId)
                ->where('appointment_id', $appointmentId)
                ->where('attendance_date', date('Y-m-d'));
            })->with('classRoom', 'attendance')->get();

            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                    'date' => $allStudentAttendanceInAppointmentIdInClassRoomId[0]->attendance[0]->attendance_date,
                    'appoinment' => new AppointmentResource($appointmentInfo),
                    "numberOfStudent" => $allStudentAttendanceInAppointmentIdInClassRoomId->count(),
                    'allStudent' => StudentResource::collection($allStudentAttendanceInAppointmentIdInClassRoomId),
                ]
            ]);

        }else {
            $allStudentsRegisteredInClassRoom = Student::whereHas('classRoom', function ($query) use ($classroomId) {
                return $query
                ->where('class_rooms.id', $classroomId)
                ->where('classroom_student.status', ClassRoom::REQISTERED);
            })->with('classRoom')->get();


            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => [
                    'allStudent' => StudentResource::collection($allStudentsRegisteredInClassRoom),
                ]
            ]);
        }


    }



}
