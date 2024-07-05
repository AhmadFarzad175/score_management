<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            font-family: 'vazir';
            direction: rtl;
        }
    </style>
</head>

<body style="width: 700px; margin-left: auto; margin-right: auto" dir="rtl">
    <table style="direction: rtl">
        <tr>
            <th rowspan="4">
                <img src="storage/images/emarat.png" style="width: 100px" alt="" />
            </th>
            <th rowspan="5" style="width: 50px"></th>
            <th style="width: 300px; font-size: 20px">وزارت معـارف</th>
            <th rowspan="5" style="width: 50px"></th>
            <th rowspan="4">
                <img src="storage/images/marif.png" style="width: 120px" alt="" />
            </th>
        </tr>

        <tr>
            <th style="font-size: 20px">ریاست معارف : ( معارف شهر کابل )</th>
        </tr>

        <tr>
            <th style="font-size: 20px">آمریت حوزه : ( حوزه هفتم تعلیمی )</th>
        </tr>

        <tr>
            <th style="font-size: 20px">مدیریت مکتب : ( لیسه عالی حبیبیه )</th>
        </tr>
        <tr style="padding-top: 100px">
            <td style="text-wrap: nowrap; font-size: 14px">اطــــلاع نامـــه صنف : (  {{$classs_name}} )</td>
            <td style="text-wrap: nowrap; font-size: 14px">مربوط نگران صنف : ( {{$negaran}} )</td>
            <td style="text-wrap: nowrap; font-size: 14px">بابت سال تعلیمی : {{$year}}</td>
        </tr>
    </table>

    <table
        style="width: 700px; border: 1px solid black; text-align: center; direction: rtl; border-collapse: collapse;">
        <tr>
            <td style="width: 110px; border: 1px solid #000;">شماره</td>
            <td colspan="3" style="border: 1px solid #000; width: 200px;">3</td>
            <td rowspan="41" style="width: 10px; border: 1px solid #000;"></td>
            <td style="width: 390px;" rowspan="5" colspan="4">
                <img src="storage/images/etlaNama.JPG" style="width: 100%; height: auto" />
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">نام</td>
            <td colspan="3" style="text-wrap: nowrap;border: 1px solid #000;">{{$first_name}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">Name</td>
            <td colspan="3" style="text-wrap: nowrap; border: 1px solid #000;">{{$first_name_en}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">تخلص</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$last_name}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">L/Name</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$last_name_en}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">نام پدر</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$father_name}}</td>
            <td style="border: 1px solid #000; width: 400px" rowspan="9" colspan="4"></td>
        </tr>

        <tr>
            <td style="border: 1px solid #000; width: 100px">F/Name</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$father_name_en}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">نام پدرکلان</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$grand_father}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">{{$base_number}}</td>
            <td colspan="3" style="border: 1px solid #000;">435432</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">نمبر تذکره</td>
            <td colspan="3" style="border: 1px solid #000;text-wrap: nowrap">{{$tazkira_number}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px; text-wrap: nowrap">تاریخ تولد شمسی</td>
            <td colspan="3" style="border: 1px solid #000;">{{$dob}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px; text-wrap: nowrap">تاریخ تولد میلادی</td>
            <td colspan="3" style="border: 1px solid #000;">{{$dob}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">سکونت اصلی</td>
            <td colspan="3" style="border: 1px solid #000;">{{$main_residence}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">مضامین</td>
            <td style="border: 1px solid #000; width: 70px">چهارونیم ماهه</td>
            <td>سالانه</td>
            <td style="border: 1px solid #000; width: 70px">نتیجه نهایی</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">تفسیر شریف</td>
            <td style="border:1px solid #000">{{ isset($sub1) ? $sub1 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; width: 340px; font-size: 13px; text-wrap: nowrap; background-color: lightgray"
                colspan="2">
                درجه بندی شاگردان به اساس اوسط مجموع نمرات در امتحان چهارونیم ماه
            </td>
            <td style="border: 1px solid #000; background-color: lightgray">نتیجه</td>
            <td style="border: 1px solid #000; background-color: lightgray">درجه</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px; text-wrap: nowrap">عقاید،فقه،حدیث</td>
            <td style="border:1px solid #000">{{ isset($sub2) ? $sub2 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 36 الی 40</td>
            <td style="border: 1px solid #000; " rowspan="4">موفق</td>
            <td style="border: 1px solid #000; ">الف</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">لسان اول</td>
            <td style="border:1px solid #000">{{ isset($sub3) ? $sub3 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 30 الی 35.99</td>
            <td style="border: 1px solid #000; ">ب</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">لسان دوم</td>
            <td style="border:1px solid #000">{{ isset($sub4) ? $sub4 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 24 الی 29.99</td>
            <td style="border: 1px solid #000; ">ج</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">لسان سوم</td>
            <td style="border:1px solid #000">31</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 20 الی 23.99</td>
            <td style="border: 1px solid #000; ">د</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">انگلیسی</td>
            <td style="border:1px solid #000">{{ isset($sub5) ? $sub5 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " rowspan="2" colspan="2">
                شاگردی که اوسط نمرات آن از 0 الی 19.99 باشد و یا حد اقل در یک مضون کمتر از 16 نمره اخذ نموده باشد.
            </td>
            <td style="border: 1px solid #000; text-wrap: nowrap" rowspan="2">تلاش بیشتر</td>
            <td rowspan="2">ه</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">ریاضی</td>
            <td style="border:1px solid #000">{{ isset($sub6) ? $sub6 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">فزیک</td>
            <td style="border:1px solid #000">{{ isset($sub7) ? $sub7 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; font-size: 13px; text-wrap: nowrap; background-color: lightgray"
                colspan="2">
                درجه بندی شاگردان به اساس اوسط مجموع نمرات در امتحان سالانه
            </td>
            <td style="border: 1px solid #000; background-color: lightgray">نتیجه</td>
            <td style="border: 1px solid #000; background-color: lightgray">درجه</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">کیمیا</td>
            <td style="border:1px solid #000">{{ isset($sub8) ? $sub8 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 90 الی 100</td>
            <td style="border: 1px solid #000; " rowspan="4">موفق</td>
            <td style="border: 1px solid #000; ">الف</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">بیولوژی</td>
            <td style="border:1px solid #000">{{ isset($sub9) ? $sub9 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 75 الی 89.99</td>
            <td style="border: 1px solid #000; ">ب</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">جیولوژی</td>
            <td style="border:1px solid #000">{{ isset($sub10) ? $sub10 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 60 الی 74.99</td>
            <td style="border: 1px solid #000; ">ج</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">تاریخ</td>
            <td style="border:1px solid #000">{{ isset($sub11) ? $sub11 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " colspan="2">از 50 الی 59.99</td>
            <td style="border: 1px solid #000; ">د</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">جغرافیه</td>
            <td style="border:1px solid #000">{{ isset($sub12) ? $sub12 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " rowspan="2" colspan="2">
                شاگردی که اوسط نمرات آن از 50 بالاتر باشد و در 1 الی 3 مضمون کمتر از 40 نمره اخد نموده باشد.
            </td>
            <td style="border: 1px solid #000; " rowspan="2">مشروط</td>
            <td rowspan="4">ه</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">تعلیمات مدنی</td>
            <td style="border:1px solid #000">{{ isset($sub13) ? $sub13 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">کمپیوتر</td>
            <td style="border:1px solid #000">{{ isset($sub14) ? $sub14 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; " rowspan="2" colspan="2">
                شاگردی که اوسط مجموع نمرات آن از 0 الی 49.99 باشد و یا در بیشتر از 3 مضمون، کمتر از 40 نمره اخذ نموده
                باشد.
            </td>
            <td style="border: 1px solid #000; " rowspan="2">تکرار صنف</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">فرهنگ</td>
            <td style="border:1px solid #000">{{ isset($sub15) ? $sub15 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">سپورت</td>
            <td style="border:1px solid #000">{{ isset($sub16) ? $sub16 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td style="border: 1px solid #000; background-color: lightgray; width: 200px;">محل امضاء</td>
            <td style="border: 1px solid #000; width: 205px; background-color: lightgray">امتحان چهارونیم ماه</td>
            <td colspan="2" style="width: 100px; background-color: lightgray">امتحان سالانه</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">تهذیب</td>
            <td style="border:1px solid #000">{{ isset($sub17) ? $sub17 : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td rowspan="2" style="border: 1px solid #000;">امضاء نگران صنف</td>
            <td rowspan="2" style="border: 1px solid #000;"></td>
            <td rowspan="2" colspan="2" style="border: 1px solid #000;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">مجموع نمرات</td>
            <td style="border:1px solid #000">{{$total_marks}}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">اوسط نمرات</td>
            <td style="border:1px solid #000">{{$average_marks}}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td rowspan="2" style="border: 1px solid #000;">امضاء سر معلم</td>
            <td rowspan="2" style="border: 1px solid #000;"></td>
            <td rowspan="2" colspan="2" style="border: 1px solid #000;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">نتیجه</td>
            <td style="border: 1px solid #000; text-wrap: nowrap">{{$result}}</td>
            <td colspan="2" style="border: 1px solid #000;text-wrap: nowrap"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">درجه</td>
            <td style="border:1px solid #000">{{$grade}}</td>
            <td colspan="2" style="border: 1px solid #000;"></td>
            <td rowspan="2" style="border: 1px solid #000;">امضاء مدیر لیسه</td>
            <td rowspan="2" style="border: 1px solid #000;"></td>
            <td rowspan="2" colspan="2" style="border: 1px solid #000;"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">ایام تعلیمی</td>
            <td style="border:1px solid #000">{{ isset($total_year) ? $total_year : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">حاضر</td>
            <td style="border:1px solid #000">{{ isset($present) ? $present : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td rowspan="2" style="border: 1px solid #000;">امضاء ولی شاگرد</td>
            <td rowspan="2" style="border: 1px solid #000;"></td>
            <td rowspan="2" colspan="2" style="border: 1px solid #000;"></td>
        </tr>

        <tr>
            <td style="border: 1px solid #000; width: 100px">غیر حاضر</td>
            <td style="border:1px solid #000">{{ isset($absent) ? $absent : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">مریض</td>
            <td style="border:1px solid #000">{{ isset($sick) ? $sick : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
            <td rowspan="2" colspan="4" style="font-size: 14px; border: 1px solid #000;">
                یادداشــــت: در صورت که شهرت، نمبر تذکره، سال تولد، سکونت اصلی و یا سایر مشخصات مربوط به شاگرد مغایرت
                داشته باشد، الی مدت سه روز بعد از ابلاغ نتایج جهت اصلاح آن به اداره لیسه مراجعه نمایند.
            </td>

        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 100px">رخصت</td>
            <td style="border:1px solid #000">{{ isset($leave) ? $leave : '/' }}</td>
            <td style="border:1px solid #000"></td>
            <td style="border:1px solid #000"></td>
        </tr>
    </table>
</body>

</html>
