import { useMainStore } from "@/Stores/mainStore";

export function useCopyText(textToTransform) {
    const mainStore = useMainStore();
    let text = "";

    try {
        if (Array.isArray(textToTransform)) {
            textToTransform.forEach((element) => {
                text = text + element + "\n\n";
            });
        } else {
            text = textToTransform;
        }

        navigator.clipboard.writeText(text);

        mainStore.toastAppear("Copied to clipboard!", "success");
    } catch (error) {
        mainStore.toastAppear("Could not copy content to clipboard: " + error, "error");
    }
}
