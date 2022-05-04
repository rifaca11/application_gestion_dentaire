<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    
     <!-- About Start -->
    <div class="container-fluid py-5 my-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                      <span><h1 class="display-5 mb-0">The World's Best Dental Clinic That You Can Trust</h1></span>
                    </div>
                    <h4 class="text-body fst-italic mb-4">If you find it difficult to choose the right dental practice for you, then Booking.dentist recommends clinics that can best solve your dental problem.
</h4>
                    <p class="mb-4">Dentist appointment scheduling & online booking system for odontologists. Planfy improves customer experience, delivers SMS & email reminders, helps manage database of patients and promote dental clinic online.</p>
                    <div class="row g-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Award Winning</h5>
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>24/7 Opened</h5>
                            <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                    <span class="colo">
                    <a href="#" class="btn btn-primary py-3 px-3 mt-4 wow zoomIn" data-wow-delay="0.6s"><router-link class="text-light text-decoration-none" :to="{ name: 'SignAccount' }">Make Appointment</router-link></a></span>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="../assets/p.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Jost:wght@600&display=swap');
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
span{
  font-size: calc(1.425rem + 2.1vw);
  font-family: "Jost",sans-serif;
}

</style>
