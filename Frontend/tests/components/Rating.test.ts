// tests/components/Books/Rating.test.ts
import { mount } from "@vue/test-utils";
import Rating from "@/components/Books/Rating.vue";
import { describe, it, expect, vi, beforeEach } from "vitest";

describe("Rating.vue", () => {
  let mockStore;
  
  beforeEach(() => {
    mockStore = {
      getters: {
        "rating/getUserRating": vi.fn().mockReturnValue(0),
        "rating/getAverageRating": vi.fn().mockReturnValue(4.5),
        "rating/hasUserRated": vi.fn().mockReturnValue(false),
        "user/user": { id: 1, Username: "TestUser" }
      },
      dispatch: vi.fn().mockResolvedValue(true)
    };
    
    vi.clearAllMocks();
  });
  
  it("prevents rating if user already rated", async () => {
    const userRatedStore = {
      getters: {
        "rating/getUserRating": vi.fn().mockReturnValue(3),
        "rating/getAverageRating": vi.fn().mockReturnValue(4.5),
        "rating/hasUserRated": vi.fn().mockReturnValue(true),
        "user/user": { id: 1, Username: "TestUser" }
      },
      dispatch: vi.fn().mockResolvedValue(true)
    };
    
    const wrapper = mount(Rating, {
      props: {
        bookId: 1
      },
      global: {
        mocks: {
          $store: userRatedStore
        }
      }
    });
    
    userRatedStore.dispatch.mockClear();
    
    const stars = wrapper.findAll(".rating__star");
    await stars[3].trigger("click");
    expect(userRatedStore.dispatch).not.toHaveBeenCalledWith("rating/addRating", expect.anything());
    
    expect(wrapper.find(".rating-message").exists()).toBe(true);
    expect(wrapper.find(".warning").text()).toContain("Ezt a könyvet már értékelted!");
  });
  
  it("prevents rating if user is not logged in", async () => {
    const notLoggedInStore = {
      getters: {
        "rating/getUserRating": vi.fn().mockReturnValue(0),
        "rating/getAverageRating": vi.fn().mockReturnValue(4.5),
        "rating/hasUserRated": vi.fn().mockReturnValue(false),
        "user/user": null
      },
      dispatch: vi.fn().mockResolvedValue(true)
    };
    
    const wrapper = mount(Rating, {
      props: {
        bookId: 1
      },
      global: {
        mocks: {
          $store: notLoggedInStore
        }
      }
    });

    notLoggedInStore.dispatch.mockClear();
    
    const stars = wrapper.findAll(".rating__star");

    await stars[3].trigger("click");

    expect(notLoggedInStore.dispatch).not.toHaveBeenCalledWith("rating/addRating", expect.anything());
    
    expect(wrapper.find(".rating-message").exists()).toBe(true);
    expect(wrapper.find(".error").text()).toContain("Az értékeléshez be kell jelentkezned!");
  });
});