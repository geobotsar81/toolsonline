import { useMainStore } from "@/Stores/mainStore";

export function useCopyText(textToTransform) {
    const mainStore = useMainStore();
    let text = textToTransform;

    try {
        if (Array.isArray(textToTransform)) {
            textToTransform.forEach((element) => {
                text = text + element + "\n\n";
            });
        }

        navigator.clipboard.writeText(text);

        mainStore.toastAppear("Copied to clipboard!", "success");
    } catch (error) {
        mainStore.toastAppear("Could not copy content to clipboard: " + error, "error");
    }
}
