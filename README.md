# File Upload

REST API 를 통한 파일 업로드 관리 서버

## TODO

* 파일 삭제
    * 파일 삭제를 하려면 uid 와 secret 을 입력 하면 삭제 하도록 한다.
    * /index.php?action=delete&uid=xxx&secret=xxxx&path=/data/upload/......
    * 파일을 삭제할 때에는 .info 파일도 같이 삭제를 해야 한다.
    
* 파일 썸네일(리사이즈) 기능
    * /index.php?action=resize&width=xxx&height=xxxx&resize=crop 와 같이 호출하고,
        파일이 이미 만들어져 있으면, 다시 만들지 않고 그냥 보여준다.
    * 썸네일 폴더는 data/thumbnails 폴더를 따로 만들어서, 언제든지 삭제 할 수 있도록 한다.

* 파일 리스트
    * /action/list.php 를 수정하여 파일 목록만 볼 수 있도록 할 것.


## Change Log

* 파일 업로드를 할 때, 파일 정보를 따로 .info 파일에 저장하지 않는다.
    => 파일명 자체에 모두 저장한다.
        공식
            u = md5() 임의 값
            s = md5( $server_secret + uid + secret )
            i = 파일이름 크기
            
            파일 명: a/s/i.확장자


## 관리

* /index.php?action=dashboard 로 접속하여 업로드된 파일을 볼 수 있음.




## 테스트 방법

$ php test/test-file-upload.php 
 
## 디버그 방법


## 파일 업로드 방법

* endpoint index.php
* parameter
    * action=file-upload
    * uid - user id.
    * secret - user secret string to update/delete file.
    * userfile - is `type=file name=userifle` of HTML FORM.

uid, secret, server secret 을 md5 한다. 따라서, 파일 삭제 할 때, uid, secret 을 올바로 입력하면 된다.
예를 들어,
    - 비 회원 글 작성을 한다면, 글 작성자는 비밀번호를 입력해야 할 것이다. 그 비밀번호를 secret 에 입력하면된다.
    - 소셜 로그인이면, 소셜 로그인 uid 가 있을 것이다. 그 값을 사용하면 된다.


## 파일 삭제 방법

## 파일 다운로드 방법



## -- 이하 오래 된 설명 (2018년 7월 이전 설명) --

* 옛날 버전은 old-version-before-2018-07 브랜치를 본다.


# version 2016-12-29

* 복잡한 md5, domain, uid 를 없앴다.
* folder 옵션을 주어서 폴더를 선택 할 수 있도록 했다.

## Getting file list of a folder.

?action=list&folder=jaeho
ex) http://work.org/file-server/index.php?action=list&folder=JJJJ




# 중요

* 용감하게 웹을 통한 파일 삭제 기능을 제공하지 않는다.

    * 즉, 웹이 아닌 cli 를 통한 삭제 기능을 제공한다. ( 웹에서 파일이 삭제될 염려가 없다. )
    
    * 이렇게 하기 위해서는
     
        1. 클라이언트 사이트에서 '사용중인 파일 목록'을 추출 할 수 있어야 한다.
    
        2. '사용중인 파일 목록'과 파일 서버에 저장된 파일 목록을 비교해서,
          
            3. '사용중인 파일 목록'에 없는 파일 서버에 저장된 파일이 있으면, 그 파일 서버의 파일을 지우면 된다.
            
            4. 서버에 저장된 파일을 지울 때에는 모든 썸네일도 같이 삭제를 해야 한다.
            
                -xs, -sm, -md, -lg, -xl 의 파일이 존재하는지 하니씩 확인한다. 아스테리크(*)로 파일 존재 확인을 하지 않는다.
                
                

* 클라이언트 사이트의 데이터베이스에 사용중인 파일을 기록해야 한다.


# 파일명과 썸네일

썸네일은 xs,sm,md,lg,xl 로 할 수 있다.

원본파일이 abcde.png 라면 abcdefgh-xs.png, abcde-sm.png, abcde-md.png, abcde-lg.png, abcde-xl.png 등으로 할 수 있다.


# 웹으로 부터 입력

"파일이름 + timestamp + ip" 를 md5 로 첫번째 문자열을 만들고
"file_server_secret_key + domain + uid" 를 md5 로 해서 두번째 문자열을 만든다.

파일을 이름은 "첫번째md5_두번째md5.확장자" 와 같이 된다.

첫번째md5 와 두번째md5 사이에 언더바(_)가 들어간다. 확장자 앞에는 점(.)가 들어간다.

그리고 썸네일에 따라, "첫번째md5_두번째md5-lg.확장자" 와 같이 파일 이름 끝에 "-md" 와 같이 크기를 지정하는 문자열이 붙는다.


# 파일 저장 경로

첫번째md5 의 첫글짜를 떼서 서브폴더를 만들고 그 안에 저장한다. 이렇게 하므로 하나의 폴더에 모든 파일이 저장되는 것을 막는다.





--------------------------------------

이하 오래된 설명

--------------------------------------


# file-upload

This is a file upload server which support many different kinds of web site.

* When a site gets bigger, the file storage gets bigger.
* When a site gets bigger, the site is needed to be distributed.
 
 And this is where file server comes.
 

# Installation

By creating upload folder, the installation will be done.

the folder path should be "data/upload/domain" where 'domain' is the input of file upload. 





# Coding guide


## Input query variable

* uid - unique users id ( it can be combination of "user unqiue NO + user login ID + Registered Date" )
* domain - unique domain of the site. it is a realm or an ID of the site.. not a actual domain.
* $_FILES['userfile'] - file upload info.



first md5 = md5 ( filename + time() + IP )
second md5 = md5( secret_key + domain + uid )


To make it difficulty to guess, the uid must be difficult to guess.

actual file name will be in "first-md5.second-md5.extension"


* Hackers may delete any file if they know 'uid'. so it is important to make 'uid' is difficult to guess.
 
* uid should be unique value for each user and should not be changed.
  

## File Server Secret Key

* Without file server secret key, one can easily guess first-md5.

    * if there is no file server secret key, one can generate md5 with random string.
        * but if there is secret key, it is more difficult to guess it.





## To delete a file.


* The user must provide domain, uid, filename.

    * ?domain=xxxx&uid=xxxx&filename=xxxxx
    
    * the script will make 'first_md5' and compare it with the file name.
    
        * if match, delete it.
        
        * if not match, the file is not owned by the user.
         

# WARNING

The 'uid' should not be exposed any where in the site.

This is very important.

When a user deletes a file, the script must generate the 'uid' on the fly and pass it to file server.



