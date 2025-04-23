// tests/components/Cart.test.ts

import { mount } from "@vue/test-utils";
import Cart from "@/components/Cart/Cart.vue";
import { describe, it, expect, vi, beforeEach } from "vitest";

describe("Cart.vue", () => {
  let mockStore: any;
  let mockRouter: any;

  beforeEach(() => {

    mockRouter = {
      push: vi.fn()
    };

    mockStore = {
      getters: {
        "cart/cart": [],
        "cart/hascart": false,
        "cart/totalSum": 0
      },
      commit: vi.fn(),
      dispatch: vi.fn()
    };

    vi.clearAllMocks();
  });

  it("redirects to /home if cart is empty on created()", () => {
    mount(Cart, {
      global: {
        mocks: {
          $store: mockStore,
          $router: mockRouter
        }
      }
    });
    expect(mockRouter.push).toHaveBeenCalledWith("/home");
  });

  it("renders cart items and total sum if hasCart is true", () => {
    mockStore.getters["cart/cart"] = [
      { id: 1, name: "Könyv A", price: 2000, quantity: 2, img: "coverA.jpg" },
      { id: 2, name: "Könyv B", price: 3000, quantity: 1, img: "coverB.jpg" }
    ];
    mockStore.getters["cart/hascart"] = true;
    mockStore.getters["cart/totalSum"] = 7000;

    const wrapper = mount(Cart, {
      global: {
        mocks: {
          $store: mockStore,
          $router: mockRouter
        }
      }
    });

    expect(wrapper.findAll("li").length).toBe(2);
    expect(wrapper.text()).toContain("Végösszeg: 7000 Ft");
  });
  it("calls addItemToTheCart when plus button clicked", async () => {
    mockStore.getters["cart/cart"] = [
      { id: 1, name: "Könyv A", price: 2000, quantity: 2, img: "coverA.jpg" }
    ];
    mockStore.getters["cart/hascart"] = true;

    const wrapper = mount(Cart, {
      global: {
        mocks: {
          $store: mockStore,
          $router: mockRouter
        }
      }
    });

    await wrapper.find(".buttons button.operators").trigger("click");

    expect(mockStore.commit).toHaveBeenCalledWith("cart/addItemToCart", {
      id: 1,
      name: "Könyv A",
      price: 2000,
      quantity: 2,
      img: "coverA.jpg"
    });
  });
  it("calls removeItemFromCart when minus button clicked", async () => {
    mockStore.getters["cart/cart"] = [
      { id: 2, name: "Könyv B", price: 3000, quantity: 1, img: "coverB.jpg" }
    ];
    mockStore.getters["cart/hascart"] = true;

    const wrapper = mount(Cart, {
      global: {
        mocks: {
          $store: mockStore,
          $router: mockRouter
        }
      }
    });

    await wrapper.findAll(".buttons button.operators")[1].trigger("click");

    expect(mockStore.commit).toHaveBeenCalledWith("cart/removeAnItemFromCart", {
      id: 2,
      name: "Könyv B",
      price: 3000,
      quantity: 1,
      img: "coverB.jpg"
    });
  });

  
});