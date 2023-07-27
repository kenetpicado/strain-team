import Swal from "sweetalert2";
import { createToaster } from "@meforma/vue-toaster";

export function getAvatarUrl(name) {
    return `https://ui-avatars.com/api/?name=${name}&rounded=true&size=256&background=F2F1FF&color=6C5EF1`;
}

export function confirmAction(props) {
    Swal.fire({
        icon: "info",
        iconColor: "#6C5EF1",
        title: props.title || "¿Estás seguro?",
        text: props.message || "Esta acción no se puede deshacer",
        showCancelButton: true,
        cancelButtonText: props.cancelText || "Cancelar",
        confirmButtonText: props.confirmText || "Si, estoy seguro",
        confirmButtonColor: "#6C5EF1",
    }).then((result) => {
        if (result.isConfirmed) {
            props.action()
        }
    });
}

export const toast = createToaster({
	position: "bottom",
	duration: 2000,
	maxToasts: 2,
});
