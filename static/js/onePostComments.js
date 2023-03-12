window.addEventListener("load", () => {
    let postId = $('.postId').text();
    postId = parseInt(postId);

    let parentCommentId = 0;

    if (!isNaN(postId)) {
        $.ajax({
            type: "POST",
            url: "/ajax/getAllCommentsOnePost",
            data: {
                postId: $('.postId').text()
            },
            success: (response) => {
                let comments = JSON.parse(response);
                console.dir(comments);

                let $commListCont = $('.comment_list_container');
                comments.forEach((item, index) => {
                        if (item.comment_Id == null) {
                            $commListCont.append(createOneComment(item, item.commentId, comments));
                        }
                    }
                );

                let replyBtn = $('.reply_btn');

                // replyBtn.forEach((reply, index) => {
                //     reply.addEventListener("click", (e)=>{
                //         console.log(parentCommentId);
                //         console.log(e.target.parentElement.parentElement.parentElement.querySelector(".d-none").innerText);
                //     })
                // });

                for (let i = 0; i < replyBtn.length; i++) {
                    replyBtn[i].addEventListener("click", (e) => {
                        console.log(parentCommentId);
                        parentCommentId = e.target.parentElement.querySelector(".d-none").innerText;
                        console.log(parentCommentId);
                    })
                }
            }
        })

        let createOneComment = (oneComm, parentId, allComments) => {
            let result = `<div class="media-block">
                                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="${oneComm.avatar}"></a>
                                   <div class="media-body">
                                   <div class="mar-btm">
                                   <a href="" class="btn-link text-semibold media-heading box-inline">${oneComm.login}</a>
                                    <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> ${oneComm.created_date}</p>
                                </div>
                            <p>${oneComm.comment}</p>
                            <div class="pad-ver">
                            <p class="d-none">${oneComm.id}</p>
                            <a href="#form" class="btn btn-sm btn-default btn-hover-primary reply_btn">Reply</a>
                            </div>
                            <hr>`;
            for (let i = 0; i < allComments.length; i++) {
                if (oneComm.id == allComments[i].comment_Id) {
                    result += createOneComment(allComments[i], oneComm.id, allComments);
                }
            }

            result += `</div></div>`
            return result;
        }

        let $commentForm = $('.comment_form');
        $commentForm.find('.comment_button').on('click', () => {

            parentCommentId = parseInt(parentCommentId);

            let comment = {
                postId: $('.postId').text(),
                login: $commentForm.find("input[name='login']").val(),
                email: $commentForm.find("input[name='email']").val(),
                comment: $commentForm.find("textarea[name='comment']").val(),
                commentId: parentCommentId
            }

            $.ajax({
                type: "POST",
                url: "/ajax/saveCommentFromPost",
                data: comment
            }).done((msg => {
                console.log(msg);
                let successAlert = $('#success-alert');

                successAlert.show();
                setTimeout(() => {
                    successAlert.fadeToggle(2000);
                }, 1500);
            }))
        });

    } else {
        console.error("Post is not defied!");
    }

});

