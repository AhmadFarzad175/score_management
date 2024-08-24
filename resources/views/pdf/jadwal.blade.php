<!DOCTYPE html>
<html lang="fa">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
      body {
        font-family: "vazir";
        direction: rtl;
      }

      .score td,
      .score th {
        border: 1px solid black;
        text-wrap: nowrap;
        margin-left: 10px;
      }

      tr {
        text-align: center;
      }

      .score {
        page-break-before: always;
      }

      /* Avoid a blank page before the first table */
      table:first-of-type {
        page-break-before: auto;
      }

      .attendance {
        border: 1px solid black;
      }

      img {
        width: 150px;
      }

      .border-top {
        border-top: 1px solid black;
      }
      .rotate td,
      .rotate th {
        height: 10px;
      }

      .rotate {
        width: 966px;
        height: 100px !important;
        border-collapse: collapse;
        transform: rotate(270deg);
        position: absolute;
        top: 399px;
        right: 61px;

    }
    </style>
  </head>

  <!-- <body style="margin-right: auto; margin-left: auto;"> -->
  <body >
    @foreach ($students as $student)
    <div style="width: 700px; margin-right: auto; margin-left: auto; display: flex; position: relative; margin-top:10px">
        <table class="rotate">
          <tr>
            <td rowspan="7">
              <img src="storage/images/emarat.png" alt="" />
            </td>
            <td rowspan="2">وزارت معارف ا.ا.ا</td>
            <td rowspan="7">
              <img src="storage/images/marif.png" alt="" />
            </td>
            <td class="attendance" style="width: 80px" colspan="2">خلص نتایج سالانه</td>
            <td class="attendance" style="width: 80px" colspan="2">خلص نتایج سالانه</td>
          </tr>
          <tr>
            <td class="attendance">تعداد داخله</td>
            <td class="attendance" style="width: 25px">{{end($students)['number_1'] ?? '/'}}</td>
            <td class="attendance">تعداد داخله</td>
            <td class="attendance" style="width: 25px"></td>
          </tr>
          <tr>
            <td rowspan="2">ریاست معارف : ( معارف شهر کابل )</td>
            <td class="attendance">شامل امتحان</td>
            <td class="attendance">{{end($students)['number_1'] ?? '/'}}</td>
            <td class="attendance">شامل امتحان</td>
            <td class="attendance"></td>
          </tr>
          <tr>
            <td class="attendance">موفق</td>
            <td class="attendance">{{end($students)['succeed_1'] ?? '/'}}</td>
            <td class="attendance">ارتقا صنف</td>
            <td class="attendance"></td>
          </tr>
          <tr>
            <td rowspan="2">آمریت حوزه : ( حوزه هفتم تعلیمی )</td>
            <td class="attendance">تلاش بیشتر</td>
            <td class="attendance">{{end($students)['faild_1'] ?? '/'}}</td>
            <td class="attendance">تکرار صنف</td>
            <td class="attendance"></td>
          </tr>
          <tr>
            <td class="attendance">معذرتی</td>
            <td class="attendance"></td>
            <td class="attendance">مشروط</td>
            <td class="attendance"></td>
          </tr>
          <tr>
            <td>مدیریت مکتب : ( لیسه عالی حبیبیه )</td>
            <td class="attendance">غایب</td>
            <td class="attendance"></td>
            <td class="attendance">معذرتی</td>
            <td class="attendance"></td>
          </tr>
          <tr>
            <td class="border-top">جدول نتایج : صنف:( {{$student['classs_name_1'] ?? ''}} )</td>
            <td class="border-top">مربوط نگران صنف : ( {{$student['negaran_1'] ?? ''}} )</td>
            <td class="border-top">بابت سال تعلیمی : {{$student['year_1'] ?? ''}}</td>
            <td class="attendance"></td>
            <td class="attendance"></td>
            <td class="attendance">محروم</td>
            <td class="attendance"></td>
          </tr>
        </table>
        <table class="score" style="width: 460px; border: 1px solid #000; border-collapse: collapse; direction: ltr;">
          <tr>
            <th>شماره</th>
            <th colspan="3">{{$student['number_1'] ?? ''}}</th>
            <th rowspan="49"></th>
            <th colspan="3">{{$student['number_2'] ?? ''}}</th>
            <th rowspan="49"></th>
            <th colspan="3">{{$student['number_3'] ?? ''}}</th>
          </tr>
    
          <tr>
            <td>نام</td>
            <td colspan="3">{{$student['first_name_1'] ?? ''}}</td>
            <td colspan="3">{{$student['first_name_2'] ?? ''}}</td>
            <td colspan="3">{{$student['first_name_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>Name</td>
            <td colspan="3">{{$student['first_name_en_1'] ?? ''}}</td>
            <td colspan="3">{{$student['first_name_en_2'] ?? ''}}</td>
            <td colspan="3">{{$student['first_name_en_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>تخلص</td>
            <td colspan="3">{{$student['last_name_1'] ?? ''}}</td>
            <td colspan="3">{{$student['last_name_2'] ?? ''}}</td>
            <td colspan="3">{{$student['last_name_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>L/Name</td>
            <td colspan="3">{{$student['last_name_en_1'] ?? ''}}</td>
            <td colspan="3">{{$student['last_name_en_2'] ?? ''}}</td>
            <td colspan="3">{{$student['last_name_en_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>نام پدر</td>
            <td colspan="3">{{$student['father_name_1'] ?? ''}}</td>
            <td colspan="3">{{$student['father_name_2'] ?? ''}}</td>
            <td colspan="3">{{$student['father_name_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>ّF/Name</td> 
            <td colspan="3">{{$student['father_name_en_1'] ?? ''}}</td>
            <td colspan="3">{{$student['father_name_en_2'] ?? ''}}</td>
            <td colspan="3">{{$student['father_name_en_3'] ?? ''}}</td>
          </tr>
          <tr>
            <td>ّنام پدرکلان</td>
            <td colspan="3">{{$student['grand_father_1'] ?? ''}}</td>
            <td colspan="3">{{$student['grand_father_2'] ?? ''}}</td>
            <td colspan="3">{{$student['grand_father_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>نمبر اساس</td>
            <td colspan="3">{{$student['base_number_1'] ?? ''}}</td>
            <td colspan="3">{{$student['base_number_2'] ?? ''}}</td>
            <td colspan="3">{{$student['base_number_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>نمبر تذکره</td>
            <td colspan="3">{{$student['tazkira_number_1'] ?? ''}}</td>
            <td colspan="3">{{$student['tazkira_number_2'] ?? ''}}</td>
            <td colspan="3">{{$student['tazkira_number_3'] ?? ''}}</td>
          </tr>
    
    
          <tr>
            <td>سال تولد شمسی</td>
            <td colspan="3">{{$student['dobShamsi_1'] ?? ''}}</td>
            <td colspan="3">{{$student['dobShamsi_2'] ?? ''}}</td>
            <td colspan="3">{{$student['dobShamsi_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>سال تولد میلادی</td>
            <td colspan="3">{{$student['dob_1'] ?? ''}}</td>
            <td colspan="3">{{$student['dob_2'] ?? ''}}</td>
            <td colspan="3">{{$student['dob_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td>سکونت اصلی</td>
            <td colspan="3">{{$student['main_residence_1'] ?? ''}}</td>
            <td colspan="3">{{$student['main_residence_2'] ?? ''}}</td>
            <td colspan="3">{{$student['main_residence_3'] ?? ''}}</td>
          </tr>
    
          <tr>
            <td class="">مضامین</td>
            <td class="">چهارونیم</td>
            <td class="">سالانه</td>
            <td class="">نهایی</td>
    
            <td class="">چهارونیم</td>
            <td class="">سالانه</td>
            <td class="">نهایی</td>
    
            <td class="">چهارونیم</td>
            <td class="">سالانه</td>
            <td class="">نهایی</td>
          </tr>
    
          <tr>
            <td>تفسیر شریف</td>
            <td>{{$student['sub1_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub1_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub1_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>عقاید، فقه، حدیث</td>
            <td>{{$student['sub2_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub2_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub2_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>لسان اول</td>
            <td>{{$student['sub3_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub3_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub3_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>لسان دوم</td>
            <td>{{$student['sub4_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub4_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub4_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>لسان سوم</td>
            <td></td>
            <td></td>
            <td></td>
    
            <td></td>
            <td></td>
            <td></td>
    
            <td></td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>انگلیسی</td>
            <td>{{$student['sub5_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub5_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub5_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>ریاضی</td>
            <td>{{$student['sub6_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub6_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub6_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>فزیک</td>
            <td>{{$student['sub7_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub7_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub7_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>کیمیا</td>
            <td>{{$student['sub8_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub8_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub8_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>بیولوژی</td>
            <td>{{$student['sub9_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub9_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub9_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>جیولوژی</td>
            <td>{{$student['sub10_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub10_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub10_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>تاریخ</td>
            <td>{{$student['sub11_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub11_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub11_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>جغرافیه</td>
            <td>{{$student['sub12_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub12_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub12_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>تعلیمات مدنی</td>
            <td>{{$student['sub13_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub13_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub13_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>کمپیوتر</td>
            <td>{{$student['sub14_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub14_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub14_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>فرهنگ</td>
            <td>{{$student['sub15_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub15_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub15_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>سپورت</td>
            <td>{{$student['sub16_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub16_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub16_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>تهذیب</td>
            <td>{{$student['sub17_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub17_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sub17_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>مجموعه نمرات</td>
            <td>{{$student['total_marks_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['total_marks_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['total_marks_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>اوسط نمرات</td>
            <td>{{$student['average_marks_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['average_marks_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['average_marks_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>نتیجه</td>
            <td>{{$student['result_1'] ?? '/'}}</td>
            <td colspan="2"></td>
    
            <td>{{$student['result_2'] ?? '/'}}</td>
            <td colspan="2"></td>
    
            <td>{{$student['result_3'] ?? '/'}}</td>
            <td colspan="2"></td>
          </tr>
    
          <tr>
            <td>درجه</td>
            <td>{{$student['grade_1'] ?? '/'}}</td>
            <td colspan="2"></td>
    
            <td>{{$student['grade_2'] ?? '/'}}</td>
            <td colspan="2"></td>
    
            <td>{{$student['grade_3'] ?? '/'}}</td>
            <td colspan="2"></td>
          </tr>
    
          <tr>
            <td>ایام تعلیمی</td>
            <td>{{$student['total_year_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['total_year_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['total_year_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>حاضر</td>
            <td>{{$student['present_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['present_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['present_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>غیر حاضر</td>
            <td>{{$student['absent_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['absent_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['absent_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>مریض</td>
            <td>{{$student['sick_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sick_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['sick_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>رخصت</td>
            <td>{{$student['leave_1'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['leave_2'] ?? '/'}}</td>
            <td></td>
            <td></td>
    
            <td>{{$student['leave_3'] ?? '/'}}</td>
            <td></td>
            <td></td>
          </tr>
    
          <tr>
            <td>عکس</td>
            <td colspan="3" style="height: 101px"></td>
    
            <td colspan="3"></td>
    
            <td colspan="3"></td>
          </tr>
        </table>

    </div>
    @endforeach


    <script>
      function printHtmlFile() {
        window.print();
      }

      document.addEventListener("DOMContentLoaded", printHtmlFile);
    </script>
  </body>
</html>
