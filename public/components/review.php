<div class="room-user-review">
    <div class="user-rating">
        <p>
            <span class="review-counter"><?=$counter+1?>.</span>
            <span><?=htmlentities($roomReview['user_name'])?></span>
        </p>
        <div>
            <ul class="star-reviews">
            <?php
                for ($i=1; $i <= 5; $i++) { 
                    if ($roomReview['rate'] >= $i){
            ?>  
            <li class="fa fa-star is-active"></li>
            <?php 
                    }else{
            ?>
                <li class="fa fa-star"></li>
            <?php     
                    }                       
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="time-added">
        <p>Add time: <?=htmlentities($roomReview['created_time'])//echo date();?></p >
    </div>
    <div class="user-comment">
        <p><?=htmlentities($roomReview['comment'])?></p>
    </div> 
    
</div>