import { mount } from "@vue/test-utils";
import CartButton from "@/components/Cart/CartButton.vue";
import { describe, it, expect, vi } from "vitest";

describe("CartButton.vue", () => {
  it("renders slot content", () => {
    const wrapper = mount(CartButton, {
      slots: {
        default: "Kosárba"
      }
    });
    
    expect(wrapper.text()).toBe("Kosárba");
  });
  
  it("navigates to cart page when clicked", async () => {
    const mockRouter = {
      push: vi.fn()
    };
    
    const wrapper = mount(CartButton, {
      global: {
        mocks: {
          $router: mockRouter
        }
      }
    });
    
    await wrapper.find("button").trigger("click");
    
    expect(mockRouter.push).toHaveBeenCalledWith("/cart");
  });
});