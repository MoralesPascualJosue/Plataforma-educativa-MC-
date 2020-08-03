$(document).ready(function() {
    // The flipping control-center
    // Two functions for every box :(

    // 1
    $(".show-me_1").on("click", function() {
        $(".box").addClass("flip1");
        $("#hitoriale").empty();
        $("#name-est").text(this.textContent);

        $.ajax({
            type: "GET",
            url: "../entregase/" + this.id,
            dataType: "json",
            success: function(data) {
                data.forEach(element => {
                    let seccion = `
                <div id="time_line_5cf90ca818fa82" class="time_line-item  item_show">
                          <div class="time_line-date_wrap">                          
                            <h4 class="time_line-date">limite: ${element["fecha_final"]}</h4>                            
                          </div>
                          <div class="time_line-content">
                            <a href="../trabajos/${element["id"]}">${element["title"]}</a>
                            <div class="time_line-descr">
                `;

                    if (element["works"] != "Sin entregas") {
                        element["works"].forEach(entrega => {
                            seccion =
                                seccion +
                                `Entrega ${entrega["entregas"]} : ${entrega["created_at"]} <br>`;
                        });
                    } else {
                        seccion = seccion + `Sin entregas`;
                    }

                    seccion =
                        seccion +
                        `</div>
                          </div>
                        </div>`;

                    $("#hitoriale").append(seccion);
                });
            },
            error: function(data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function(i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    });

    $(".hide-me_1").on("click", function() {
        $(".box").removeClass("flip1");
    });

    $('[class*="-me_"]').click(function() {
        var boxclass = $(".box").attr("class");
        $("p.boxclass").html(boxclass);
    });
}); // .ready-END

$(function() {
    $("#selectable").selectable();
});
